<div class="container-fluid d-flex align-items-stretch justify-content-between">
    <!--begin::Header Menu Wrapper-->
    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
        <!--begin::Header Menu-->
        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
            <!--begin::Header Nav-->
{{--            <ul class="menu-nav">--}}
{{--                <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click"--}}
{{--                    aria-haspopup="true">--}}
                    <form action="{{route('call_tracking')}}" method="post" enctype="multipart/form-data" >@csrf
                        <button type="submit" class="btn-success form-control" name="call">Call tracking</button>
                    </form>
{{--                    <form action="{{route('exportfile')}}" method="get" enctype="multipart/form-data" hidden>@csrf--}}
{{--                        <button type="submit" class="btn-success form-control" name="call">Export Tracking</button>--}}
{{--                    </form>--}}
{{--                </li>--}}
{{--            </ul>--}}
            <!--end::Header Nav-->
        </div>
        <!--end::Header Menu-->
    </div>
    <!--end::Header Menu Wrapper-->
    <!--begin::Topbar-->
    <div class="topbar">
        <!--begin::User-->
        <div class="topbar-item">
            <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2"
                 id="kt_quick_user_toggle">
                                <span
                                    class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Sean</span>
                <span class="symbol symbol-35 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold">S</span>
										</span>
            </div>
        </div>
        <!--end::User-->
    </div>
    <!--end::Topbar-->
</div>
