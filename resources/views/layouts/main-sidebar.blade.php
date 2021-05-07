<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/2.png')}}" class="" height="120" alt="logo" style="margin-top: -38px;"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset(auth()->user()->profile->avatar ?? 'Images/default.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{auth()->user()->name}}</h4>
							<span class="mb-0 text-muted">Administrator</span>
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">الرئيسية</li>
					<li class="slide">
						<a class="side-menu__item" href="{{ url('/index') }}">
							<i class="fas fa-home fa-lg ml-3"></i>
							<span class="side-menu__label">الصفحة الرئيسية</span>
							<span class="badge badge-success side-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
						</a>
					</li>
					<li class="side-item side-item-category">الفواتير</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#!') }}">
							<i class="fas fa-file-invoice  fa-lg ml-3"></i>
							<span class="side-menu__label">الفواتير</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='invoices') }}">قائمة الفواتير</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='paid_invoices') }}"> قائمة الفواتيرالمدفوعة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='unpaid_invoices') }}">قائمة الفواتير الغير مدفوعة</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='partial_paid_invoices') }}">قائمة الفواتير المدفوعة جزئيا</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='archieved_invoices') }}">قائمة الأرشيف</a></li>
							
						</ul>
					</li>
					<li class="side-item side-item-category">الشراءات</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#!') }}"><i class="fas fa-boxes  fa-lg ml-3"></i><span class="side-menu__label">الشراءات</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/suppliers') }}">قائمة الموردين</a></li>
							<li><a class="slide-item" href="{{ url('/purchase_orders') }}">قائمة طلبات الشراء</a></li>
							<li><a class="slide-item" href="{{ url('/purchase_delivery_notes') }}">قائمة مزكرات تسليم الموردين</a></li>

							<li><a class="slide-item" href="{{ url('/purchase_invoices') }}">قائمة فواتير الشراء</a></li>
							
						</ul>
						
					</li>
					<li class="side-item side-item-category">المبيعات</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#!') }}">
							<i class="fas fa-file-invoice-dollar fa-lg ml-3"></i>
							<span class="side-menu__label">المبيعات</span><i class="angle fe fe-chevron-down"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="{{ url('/sales') }}">قائمة المبيعات</a></li>
								
							</ul>
						
					</li>

					<li class="side-item side-item-category">الإعدادات</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#!') }}">
							<i class="fas fa-cogs  fa-lg ml-3"></i>
							<span class="side-menu__label">الإعدادات</span><i class="angle fe fe-chevron-down"></i></a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/settings/categories') }}">الأقسام</a></li>
						</ul>
					</li>
					<li class="side-item side-item-category">العملاء</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#!') }}">
							<i class="fas fa-user-tie fa-lg ml-3"></i>
							<span class="side-menu__label">المستخدمين و العملاء</span><i class="angle fe fe-chevron-down"></i>
						</a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url('/' . $page='clients') }}">العملاء</a></li>
							<li><a class="slide-item" href="{{ url('/users') }}">المستخدمين</a></li>
						</ul>
					</li>
					<li class="side-item side-item-category">الكتالوج</li>
					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#!') }}">
							<i class="fas fa-cubes fa-lg ml-3"></i>
							<span class="side-menu__label">كتالوج الخدمات</span><i class="angle fe fe-chevron-down"></i>
						</a>
						<ul class="slide-menu">
							<li><a class="slide-item" href="{{ url("/catalog/products") }}">المنتجات</a></li>
							<li><a class="slide-item" href="{{ url('/catalog/services') }}">الخدمات</a></li>
							<li><a class="slide-item" href="{{ url('/catalog/expenses_investment') }}">النفقات و الإستثمارات</a></li>
							<li><a class="slide-item" href="{{ url('/' . $page='products') }}">ممتلكات العملاء</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
