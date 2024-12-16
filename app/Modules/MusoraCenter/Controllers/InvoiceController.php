<?php

namespace App\Modules\MusoraCenter\Controllers;

use Illuminate\View\View;
use Illuminate\Routing\Controller;
use Railroad\Ecommerce\Exceptions\NotFoundException;
use Railroad\Ecommerce\Repositories\PaymentRepository;
use Railroad\Ecommerce\Services\InvoiceService;
use Railroad\Permissions\Services\PermissionService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InvoiceController extends Controller
{
    /**
     * @var InvoiceService
     */
    private $invoiceService;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var PermissionService
     */
    private $permissionService;

    public function __construct(
        InvoiceService $invoiceService,
        PaymentRepository $paymentRepository,
        PermissionService $permissionService
    ) {
        $this->invoiceService = $invoiceService;
        $this->paymentRepository = $paymentRepository;
        $this->permissionService = $permissionService;
    }

    /**
     * @param $paymentId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * @throws NotFoundException
     * @throws \Doctrine\ORM\ORMException
     */
    public function show($paymentId): View
    {
        $this->permissionService->canOrThrow(auth()->id(), 'send_payment_invoice');

        $payment = $this->paymentRepository->find($paymentId);

        $order = $payment->getOrder();
        $subscription = $payment->getSubscription();



        if (!empty($order) && !empty(
            config(
                'ecommerce.invoice_email_details.' . $payment->getGatewayName() . '.order_invoice.invoice_view'
            )
        )) {
            $viewData = $this->invoiceService->getViewDataForOrderInvoice($order, $payment);

            return view(
                config('ecommerce.invoice_email_details.' . $payment->getGatewayName() . '.order_invoice.invoice_view'),
                $viewData
            );
        }

        if (!empty($subscription) && !empty(
            config(
                'ecommerce.invoice_email_details.' .
                $payment->getGatewayName() .
                '.subscription_renewal_invoice.invoice_view'
            )
        )) {
            $viewData = $this->invoiceService->getViewDataForSubscriptionRenewalInvoice($subscription, $payment);

            return view(
                config(
                    'ecommerce.invoice_email_details.' .
                    $payment->getGatewayName() .
                    '.subscription_renewal_invoice.invoice_view'
                ),
                $viewData
            );
        }

        throw new NotFoundHttpException();
    }
}
