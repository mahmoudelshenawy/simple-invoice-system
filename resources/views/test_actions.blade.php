    <div class="dropdown">

        <button aria-expanded="false" aria-haspopup="true"
            class="btn ripple btn-primary" data-toggle="dropdown"
            type="button">العمليات<i class="fas fa-caret-down ml-1"></i></button>
            <div class="dropdown-menu tx-13">
                @can('control_invoices')
                    <a class="dropdown-item"
                        href="/invoice_data/{{$id}}">تعديل
                        الفاتورة</a>
                @endcan

                @can('control_invoices')
                    <a class="dropdown-item modal-effect" href="#" data-invoice_id="{{ $id }}"
                        data-effect="effect-scale"
                        data-id="{{ $id }}" data-invoice_name="{{ $title }}"
                        data-toggle="modal" data-target="#deleteserviceModal"><i
                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                        الفاتورة</a>
                @endcan

                @can('control_invoices')
                    <a class="dropdown-item"
                        href="invoices/change_payment_status/{{$id}}">
                        <i class="text-success fas fa-money-bill"></i>&nbsp;&nbsp;
                        تغير
                        حالة
                        الدفع
                    </a>
                @endcan

                @can('archieve_invoices')
                    <a class="dropdown-item" href="#" data-invoice_id="{{ $id }}"
                        data-toggle="modal" data-target="#Transfer_invoice"><i
                            class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                        الارشيف</a>
                @endcan

                @can('control_invoices')
                    <a class="dropdown-item" href="print_invoice/{{ $id }}"><i
                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                        الفاتورة
                    </a>
                @endcan
            </div>
    </div>
