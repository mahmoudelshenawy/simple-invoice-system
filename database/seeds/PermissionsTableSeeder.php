<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_Array = [
            'Purchases' => [
                'control_purchase_orders',
                'control_purchase_delivery_notes',
                'control_purchase_invoices',
                'control_suppliers'
            ],
            'Sales' => [
                'control_sales'
            ],
            'Clients' => [
                'control_clients'
            ],
            'Invoices' => [
                'control_invoices',
                'archieve_invoices'
            ],
            'Catalog' => [
                'control_products',
                'control_services',
                'control_expenses',
                'control_investments',
                'control_client_assets',
            ],
            'Users' => [
                'add_users',
                'edit_users',
                'delete_users',
                'give_some_permissions',
                'give_all_permissions',
                'control_users'
            ],
            'Notifications' => [
                'read_notifications'
            ],
            'Reports' => [],
            'Settings' => [
                'control_settings'
            ]
        ];
        $permissions = [

            'الفواتير',
            'قائمة الفواتير',
            'الفواتير المدفوعة',
            'الفواتير المدفوعة جزئيا',
            'الفواتير الغير مدفوعة',
            'ارشيف الفواتير',
            'التقارير',
            'تقرير الفواتير',
            'تقرير العملاء',
            'المستخدمين',
            'قائمة المستخدمين',
            'صلاحيات المستخدمين',
            'الاعدادات',
            'المنتجات',
            'الاقسام',


            'اضافة فاتورة',
            'حذف الفاتورة',
            'تصدير EXCEL',
            'تغير حالة الدفع',
            'تعديل الفاتورة',
            'ارشفة الفاتورة',
            'طباعةالفاتورة',
            'اضافة مرفق',
            'حذف المرفق',

            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',

            'اضافة قسم',
            'تعديل قسم',
            'حذف قسم',
            'الاشعارات',

        ];

        foreach ($permissions_Array as $domain => $arr) {
            foreach ($arr as $value) {
                Permission::create([
                    'domain' => $domain,
                    'name'  => $value
                ]);
            }
        }

        // foreach ($permissions as $permission) {

        //     Permission::create(['name' => $permission]);
        // }
    }
}
