    <!-- <div class="">
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    </div> -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <div class="logo">
                    <a href="#" class="">
                      <div class="bg-logo-sidebar p-2 text-center"><img src="<?php echo base_url('assets/logo/'.getComponent('APP.LOGO')) ?>" class="ml-3" alt=""><span></span></div>
                    </a>
                </div>
                <ul>

                        <li class="<?php if (isset($this->uri->segments[2]) && isset($this->uri->segments[3])) {
                                echo strtolower($this->uri->segments[2]) == 'diampu' && strtolower($this->uri->segments[3]) == 'list_pengampu' ? 'active' : '';
                            } ?>">
                            <a href="<?php echo base_url('diampu/Diampu/list_pengampu') ?>">
                                <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                <path d="M9 3H15V7.5H9V3ZM9 15.75V8.25H15V15.75H9ZM2.25 15.75V11.25H8.25V15.75H2.25ZM2.25 10.5V3H8.25V10.5H2.25ZM3 3.75V9.75H7.5V3.75H3ZM9.75 3.75V6.75H14.25V3.75H9.75ZM9.75 9V15H14.25V9H9.75ZM3 12V15H7.5V12H3Z" fill="black"/>
                                </svg></i>
                                    <span>List Pengampu</span></a>
                        </li>
                        <li class="mb-5 pb-5 d-mobile-show">
                        <a href="<?php echo base_url('logout') ?>"><!-- <i class="fas fa-sign-out-alt"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M3 9C3 9.19891 3.07902 9.38968 3.21967 9.53033C3.36032 9.67098 3.55109 9.75 3.75 9.75H9.4425L7.7175 11.4675C7.6472 11.5372 7.59141 11.6202 7.55333 11.7116C7.51526 11.803 7.49565 11.901 7.49565 12C7.49565 12.099 7.51526 12.197 7.55333 12.2884C7.59141 12.3798 7.6472 12.4628 7.7175 12.5325C7.78722 12.6028 7.87017 12.6586 7.96157 12.6967C8.05296 12.7347 8.15099 12.7543 8.25 12.7543C8.34901 12.7543 8.44704 12.7347 8.53843 12.6967C8.62983 12.6586 8.71278 12.6028 8.7825 12.5325L11.7825 9.5325C11.8508 9.46117 11.9043 9.37706 11.94 9.285C12.015 9.1024 12.015 8.8976 11.94 8.715C11.9043 8.62294 11.8508 8.53883 11.7825 8.4675L8.7825 5.4675C8.71257 5.39757 8.62955 5.3421 8.53819 5.30426C8.44682 5.26641 8.34889 5.24693 8.25 5.24693C8.15111 5.24693 8.05318 5.26641 7.96181 5.30426C7.87045 5.3421 7.78743 5.39757 7.7175 5.4675C7.64757 5.53743 7.5921 5.62045 7.55426 5.71181C7.51641 5.80318 7.49693 5.90111 7.49693 6C7.49693 6.09889 7.51641 6.19682 7.55426 6.28819C7.5921 6.37955 7.64757 6.46257 7.7175 6.5325L9.4425 8.25H3.75C3.55109 8.25 3.36032 8.32902 3.21967 8.46967C3.07902 8.61032 3 8.80109 3 9V9ZM12.75 1.5H5.25C4.65326 1.5 4.08097 1.73705 3.65901 2.15901C3.23705 2.58097 3 3.15326 3 3.75V6C3 6.19891 3.07902 6.38968 3.21967 6.53033C3.36032 6.67098 3.55109 6.75 3.75 6.75C3.94891 6.75 4.13968 6.67098 4.28033 6.53033C4.42098 6.38968 4.5 6.19891 4.5 6V3.75C4.5 3.55109 4.57902 3.36032 4.71967 3.21967C4.86032 3.07902 5.05109 3 5.25 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.25C13.5 14.4489 13.421 14.6397 13.2803 14.7803C13.1397 14.921 12.9489 15 12.75 15H5.25C5.05109 15 4.86032 14.921 4.71967 14.7803C4.57902 14.6397 4.5 14.4489 4.5 14.25V12C4.5 11.8011 4.42098 11.6103 4.28033 11.4697C4.13968 11.329 3.94891 11.25 3.75 11.25C3.55109 11.25 3.36032 11.329 3.21967 11.4697C3.07902 11.6103 3 11.8011 3 12V14.25C3 14.8467 3.23705 15.419 3.65901 15.841C4.08097 16.2629 4.65326 16.5 5.25 16.5H12.75C13.3467 16.5 13.919 16.2629 14.341 15.841C14.7629 15.419 15 14.8467 15 14.25V3.75C15 3.15326 14.7629 2.58097 14.341 2.15901C13.919 1.73705 13.3467 1.5 12.75 1.5Z" fill="black"/>
                                </svg></i>
                         <span>Keluar</span></a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="sidebar-footer">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <div class="pt-3"></div>
                    <hr class="mx-3" color="white">
                    <!-- <li class="pt-0">
                        <a href="<?php echo base_url('admin/Profil'); ?>">
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M1.719 6.6447C2.05155 5.61787 2.59784 4.67314 3.3219 3.8727C3.38175 3.80656 3.4599 3.7597 3.54643 3.73807C3.63296 3.71644 3.72397 3.72101 3.8079 3.7512L5.5341 4.3686C5.65699 4.41248 5.78795 4.42912 5.9179 4.41735C6.04786 4.40559 6.17371 4.3657 6.28671 4.30047C6.39972 4.23523 6.4972 4.1462 6.57238 4.03954C6.64755 3.93289 6.69864 3.81116 6.7221 3.6828L7.0506 1.8774C7.06651 1.78951 7.10821 1.70835 7.1704 1.64424C7.23258 1.58013 7.31244 1.53598 7.3998 1.5174C8.45447 1.29275 9.54463 1.29275 10.5993 1.5174C10.6867 1.53598 10.7665 1.58013 10.8287 1.64424C10.8909 1.70835 10.9326 1.78951 10.9485 1.8774L11.2779 3.6828C11.3014 3.81116 11.3524 3.93289 11.4276 4.03954C11.5028 4.1462 11.6003 4.23523 11.7133 4.30047C11.8263 4.3657 11.9521 4.40559 12.0821 4.41735C12.2121 4.42912 12.343 4.41248 12.4659 4.3686L14.193 3.7512C14.2769 3.72131 14.3678 3.71698 14.4541 3.73877C14.5405 3.76056 14.6184 3.80748 14.6781 3.8736C15.4017 4.67386 15.9477 5.61827 16.2801 6.6447C16.3075 6.72949 16.3092 6.82051 16.2848 6.90623C16.2605 6.99195 16.2112 7.06851 16.1433 7.1262L14.7438 8.3142C14.6444 8.39869 14.5645 8.50378 14.5098 8.6222C14.455 8.74062 14.4266 8.86953 14.4266 9C14.4266 9.13047 14.455 9.25938 14.5098 9.3778C14.5645 9.49622 14.6444 9.60131 14.7438 9.6858L16.1433 10.8738C16.2112 10.9315 16.2605 11.0081 16.2848 11.0938C16.3092 11.1795 16.3075 11.2705 16.2801 11.3553C15.9478 12.3821 15.4018 13.3268 14.6781 14.1273C14.6183 14.1934 14.5401 14.2403 14.4536 14.2619C14.367 14.2836 14.276 14.279 14.1921 14.2488L12.4659 13.6314C12.343 13.5875 12.2121 13.5709 12.0821 13.5826C11.9521 13.5944 11.8263 13.6343 11.7133 13.6995C11.6003 13.7648 11.5028 13.8538 11.4276 13.9605C11.3524 14.0671 11.3014 14.1888 11.2779 14.3172L10.9476 16.1235C10.9316 16.2111 10.8899 16.292 10.8279 16.3559C10.7659 16.4198 10.6864 16.4639 10.5993 16.4826C9.54464 16.7073 8.45446 16.7073 7.3998 16.4826C7.31244 16.464 7.23258 16.4199 7.1704 16.3558C7.10821 16.2917 7.06651 16.2105 7.0506 16.1226L6.7221 14.3172C6.69864 14.1888 6.64755 14.0671 6.57238 13.9605C6.4972 13.8538 6.39972 13.7648 6.28671 13.6995C6.17371 13.6343 6.04786 13.5944 5.9179 13.5826C5.78795 13.5709 5.65699 13.5875 5.5341 13.6314L3.807 14.2488C3.7231 14.2787 3.63223 14.283 3.54587 14.2612C3.45952 14.2394 3.38157 14.1925 3.3219 14.1264C2.59825 13.3262 2.05227 12.3817 1.7199 11.3553C1.69246 11.2705 1.69082 11.1795 1.71517 11.0938C1.73953 11.0081 1.78878 10.9315 1.8567 10.8738L3.2562 9.6858C3.35562 9.60131 3.43548 9.49622 3.49025 9.3778C3.54501 9.25938 3.57338 9.13047 3.57338 9C3.57338 8.86953 3.54501 8.74062 3.49025 8.6222C3.43548 8.50378 3.35562 8.39869 3.2562 8.3142L1.8567 7.1262C1.78878 7.06851 1.73953 6.99195 1.71517 6.90623C1.69082 6.82051 1.69246 6.72949 1.7199 6.6447H1.719ZM2.6739 6.6393L3.8385 7.6275C4.03764 7.79648 4.19763 8.00677 4.30736 8.24377C4.41709 8.48078 4.47392 8.73883 4.47392 9C4.47392 9.26118 4.41709 9.51922 4.30736 9.75623C4.19763 9.99323 4.03764 10.2035 3.8385 10.3725L2.6739 11.3607C2.9367 12.0645 3.3165 12.7197 3.7944 13.2975L5.2308 12.7845C5.47664 12.6967 5.73862 12.6635 5.99859 12.6871C6.25856 12.7107 6.51029 12.7905 6.73632 12.9211C6.96235 13.0516 7.15728 13.2298 7.30759 13.4432C7.4579 13.6566 7.56 13.9002 7.6068 14.157L7.8813 15.6582C8.62169 15.7816 9.37741 15.7816 10.1178 15.6582L10.3923 14.1552C10.4392 13.8985 10.5414 13.655 10.6917 13.4417C10.8421 13.2284 11.0371 13.0503 11.2631 12.9199C11.4891 12.7894 11.7408 12.7096 12.0007 12.6861C12.2606 12.6626 12.5225 12.6958 12.7683 12.7836L14.2056 13.2975C14.6844 12.7188 15.0631 12.0642 15.3261 11.3607L14.1615 10.3725C13.9621 10.2037 13.8018 9.99346 13.6919 9.75643C13.582 9.51941 13.5251 9.26127 13.5251 9C13.5251 8.73873 13.582 8.4806 13.6919 8.24357C13.8018 8.00654 13.9621 7.79631 14.1615 7.6275L15.3261 6.6393C15.0631 5.93579 14.6844 5.28117 14.2056 4.7025L12.7692 5.2155C12.5234 5.30326 12.2615 5.33653 12.0016 5.313C11.7417 5.28947 11.49 5.20971 11.264 5.07923C11.0379 4.94876 10.843 4.7707 10.6926 4.55739C10.5423 4.34408 10.4401 4.10063 10.3932 3.8439L10.1178 2.3418C9.37741 2.21836 8.62169 2.21836 7.8813 2.3418L7.6077 3.8439C7.5609 4.10071 7.4588 4.34426 7.30849 4.55767C7.15818 4.77109 6.96325 4.94925 6.73722 5.07982C6.51119 5.21039 6.25946 5.29024 5.99949 5.31382C5.73953 5.3374 5.47754 5.30416 5.2317 5.2164L3.7944 4.7025C3.31562 5.28118 2.93691 5.93579 2.6739 6.6393V6.6393ZM6.75 9C6.75 8.40326 6.98705 7.83097 7.40901 7.40901C7.83097 6.98705 8.40326 6.75 9 6.75C9.59674 6.75 10.169 6.98705 10.591 7.40901C11.0129 7.83097 11.25 8.40326 11.25 9C11.25 9.59674 11.0129 10.169 10.591 10.591C10.169 11.0129 9.59674 11.25 9 11.25C8.40326 11.25 7.83097 11.0129 7.40901 10.591C6.98705 10.169 6.75 9.59674 6.75 9ZM7.65 9C7.65 9.35804 7.79223 9.70142 8.04541 9.9546C8.29858 10.2078 8.64196 10.35 9 10.35C9.35804 10.35 9.70142 10.2078 9.95459 9.9546C10.2078 9.70142 10.35 9.35804 10.35 9C10.35 8.64196 10.2078 8.29858 9.95459 8.04541C9.70142 7.79223 9.35804 7.65 9 7.65C8.64196 7.65 8.29858 7.79223 8.04541 8.04541C7.79223 8.29858 7.65 8.64196 7.65 9V9Z" fill="black"/>
                                </svg></i>
                         <span>Pengaturan</span></a>
                    </li> -->
                    <li class="mb-5 pb-5">
                        <a href="<?php echo base_url('logout') ?>"><!-- <i class="fas fa-sign-out-alt"></i> -->
                            <i><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                <path d="M3 9C3 9.19891 3.07902 9.38968 3.21967 9.53033C3.36032 9.67098 3.55109 9.75 3.75 9.75H9.4425L7.7175 11.4675C7.6472 11.5372 7.59141 11.6202 7.55333 11.7116C7.51526 11.803 7.49565 11.901 7.49565 12C7.49565 12.099 7.51526 12.197 7.55333 12.2884C7.59141 12.3798 7.6472 12.4628 7.7175 12.5325C7.78722 12.6028 7.87017 12.6586 7.96157 12.6967C8.05296 12.7347 8.15099 12.7543 8.25 12.7543C8.34901 12.7543 8.44704 12.7347 8.53843 12.6967C8.62983 12.6586 8.71278 12.6028 8.7825 12.5325L11.7825 9.5325C11.8508 9.46117 11.9043 9.37706 11.94 9.285C12.015 9.1024 12.015 8.8976 11.94 8.715C11.9043 8.62294 11.8508 8.53883 11.7825 8.4675L8.7825 5.4675C8.71257 5.39757 8.62955 5.3421 8.53819 5.30426C8.44682 5.26641 8.34889 5.24693 8.25 5.24693C8.15111 5.24693 8.05318 5.26641 7.96181 5.30426C7.87045 5.3421 7.78743 5.39757 7.7175 5.4675C7.64757 5.53743 7.5921 5.62045 7.55426 5.71181C7.51641 5.80318 7.49693 5.90111 7.49693 6C7.49693 6.09889 7.51641 6.19682 7.55426 6.28819C7.5921 6.37955 7.64757 6.46257 7.7175 6.5325L9.4425 8.25H3.75C3.55109 8.25 3.36032 8.32902 3.21967 8.46967C3.07902 8.61032 3 8.80109 3 9V9ZM12.75 1.5H5.25C4.65326 1.5 4.08097 1.73705 3.65901 2.15901C3.23705 2.58097 3 3.15326 3 3.75V6C3 6.19891 3.07902 6.38968 3.21967 6.53033C3.36032 6.67098 3.55109 6.75 3.75 6.75C3.94891 6.75 4.13968 6.67098 4.28033 6.53033C4.42098 6.38968 4.5 6.19891 4.5 6V3.75C4.5 3.55109 4.57902 3.36032 4.71967 3.21967C4.86032 3.07902 5.05109 3 5.25 3H12.75C12.9489 3 13.1397 3.07902 13.2803 3.21967C13.421 3.36032 13.5 3.55109 13.5 3.75V14.25C13.5 14.4489 13.421 14.6397 13.2803 14.7803C13.1397 14.921 12.9489 15 12.75 15H5.25C5.05109 15 4.86032 14.921 4.71967 14.7803C4.57902 14.6397 4.5 14.4489 4.5 14.25V12C4.5 11.8011 4.42098 11.6103 4.28033 11.4697C4.13968 11.329 3.94891 11.25 3.75 11.25C3.55109 11.25 3.36032 11.329 3.21967 11.4697C3.07902 11.6103 3 11.8011 3 12V14.25C3 14.8467 3.23705 15.419 3.65901 15.841C4.08097 16.2629 4.65326 16.5 5.25 16.5H12.75C13.3467 16.5 13.919 16.2629 14.341 15.841C14.7629 15.419 15 14.8467 15 14.25V3.75C15 3.15326 14.7629 2.58097 14.341 2.15901C13.919 1.73705 13.3467 1.5 12.75 1.5Z" fill="black"/>
                                </svg></i>
                         <span>Keluar</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<style>
    hr{
        height: 8px;
        border: 0;
        box-shadow: 0 10px 10px -10px #fff inset;
    }
</style>
