<?php

namespace App\Http\Controllers;

use App\Models\CourseOrder;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Order;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CheckoutController extends FrontController
{
    private $courseModel;
    private $courseOrderModel;

    public function __construct()
    {
        $this->courseModel = new Course();
        $this->courseOrderModel = new CourseOrder();
    }

    public function checkout()
    {
        $stripe = new \Stripe\StripeClient('sk_test_51M6FPJLWXnryLuL450g74dl6RCESGZXY7fFHSnsjMWoHSlJ8GWhJdeHPuYcjuO7R8DDKzSJicMd71bkROT7EBvfo003W2WfyEx');

        $idUser = session()->get('user')->id_user;

        $idsForExplode = $_POST['cartItems'];
        $cartItems = explode(',', $idsForExplode);
        $courses = $this->courseModel->getCoursesInCart($cartItems);

        $totalPrice = 0;

        $lineItems = [];
        foreach ($courses as $course) {
            $totalPrice += $course->price;

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $course->course_name
                    ],
                    'unit_amount' => $course->price * 100 // usd cents
                ],
                'quantity' => 1
            ];
        }

        $courses_ids = [];
        foreach ($courses as $course) {
            $courses_ids[] = $course->id_course;
        }
        $imploded_courses = implode(',', $courses_ids);

        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true) . "?id_session={CHECKOUT_SESSION_ID}&courses=$imploded_courses",
            'cancel_url' => route('checkout.cancel', [], true),
        ]);

        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = $totalPrice; // $totalPrice
        $order->id_session = $checkout_session->id;
        $order->id_user = $idUser;
        $order->save();

        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);

        return redirect($checkout_session->url);
    }

    public function success(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_51M6FPJLWXnryLuL450g74dl6RCESGZXY7fFHSnsjMWoHSlJ8GWhJdeHPuYcjuO7R8DDKzSJicMd71bkROT7EBvfo003W2WfyEx');
        $sessionId = $request->get('id_session');

        try {
            $session = $stripe->checkout->sessions->retrieve($sessionId);

            if (!$session) {
                throw new NotFoundHttpException;
            }

            $order = Order::where('id_session', $session->id)->first();

            if (!$order) {
                throw new NotFoundHttpException();
            }

            if ($order->status === "unpaid") {
                $courses = $_GET['courses'];

                $exploded_courses = explode(',', $courses);

                $order_last_id = $order->id_course_order;

                foreach ($exploded_courses as $course) {
                    $courses_ids = $course;
                    $this->courseOrderModel->insertCourseOrder($courses_ids, $order_last_id);
                }

                $order = Order::where('id_session', $session->id)->update(['status' => 'paid']);
            }

            return view('pages.user.checkout-success');
        } catch (Exception $ex) {
            throw new NotFoundHttpException;
        }
    }

    public function cancel()
    {
        return view('pages.user.checkout-cancel');
    }

    public function webhook()
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_0fb25c7c9f0846d453948ad3651a63cb6b12f95076edae2e553b5b1ec3e56cd3';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(400);
        }

        // Handle the event
        switch ($event->type) {
            // jedini case mi treba 'checkout.session.completed' i onda radim isto sto i u success.
            case 'checkout.session.completed':
                $session = $event->data->object;
                $success_url = $session->success_url;

                $order = Order::where('id_session', $session->id)->first();
                if (!$order) {
                    throw new NotFoundHttpException();
                }
                if ($order->status === "unpaid") {
                    $courses = substr($success_url, strrpos($success_url, '=') + 1);
                    $exploded_courses = explode(',', $courses);
                    $order_last_id = $order->id_course_order;

                    foreach ($exploded_courses as $course) {
                        $courses_ids = $course;
                        $this->courseOrderModel->insertCourseOrder($courses_ids, $order_last_id);
                    }

                    $order = Order::where('id_session', $session->id)->update(['status' => 'paid']);
                }
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }
}
