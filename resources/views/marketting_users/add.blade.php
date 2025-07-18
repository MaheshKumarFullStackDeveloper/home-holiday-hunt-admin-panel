@extends('adminlte::page')

@section('title', 'Add Marketing User')

@section('content_header')
 

@section('content')

<div class="container px-1">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header alert d-flex justify-content-between align-items-center">
               <div class="d-flex align-items-center">
                  <div class="icon_main">
                     <i class="fas fa-fw fa-user-friends "></i>
                  </div>
                  <h3>Add Marketing User</h3>
               </div>
               <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            </div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <form id="addUser" method="post"  action="{{ route('marketting.save_user') }}" onload="resetForm()" autocomplete="off" enctype="multipart/form-data">
                  @csrf
                  <div class="row mx-0">
                     <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="profile-image-show mt-3">
                           <a href="javascript:;" class="remove-pro-img  d-none"  style="display:block">
                              <svg width="25" height="25" viewBox="0 0 257 256" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <g clip-path="url(#clip0_2088_553)">
                                    <path d="M254.85 141.81C253.9 157.47 249.21 172.11 241.97 185.85C222.7 222.45 192.59 244.9 152.18 253.57C150.9 253.85 149.55 253.82 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z" fill="#F7F9FA"/>
                                    <path d="M254.85 141.81C251.98 142.27 250.79 139.87 249.24 138.32C230 119.18 210.83 99.9701 191.64 80.7801C190.08 79.2301 188.55 77.6401 186.86 76.2301C186.73 76.1101 186.6 76.0101 186.47 75.9101C186.37 75.8201 186.27 75.7401 186.17 75.6601C179.43 68.4101 174.9 68.2601 167.78 75.3201C156.31 86.6701 144.95 98.1401 133.52 109.53C128.75 114.28 128.21 114.29 123.52 109.63C111.61 97.7701 99.7803 85.8401 87.8503 74.0101C83.5703 69.7701 79.6603 69.0701 75.8503 71.6001C70.9103 74.8801 70.1903 80.2701 74.3803 84.8201C79.1203 89.9501 84.2103 94.7501 89.1403 99.7001C96.6603 107.24 104.24 114.72 111.71 122.31C115.58 126.24 115.59 127.4 111.66 131.37C100.3 142.84 88.8503 154.21 77.4403 165.63C76.0403 167.04 74.5503 168.4 73.4803 170.11C70.4303 174.98 71.1603 179.23 75.6803 182.84C76.5803 183.56 77.6903 184.03 78.3503 185.05C78.4203 185.21 78.4903 185.36 78.5803 185.51C78.5903 185.55 78.6103 185.59 78.6403 185.63C79.4203 187.06 80.6103 188.16 81.7603 189.31C101.43 208.97 121.13 228.61 140.72 248.36C142.99 250.65 145.76 252.04 148.23 253.94C127.66 257.72 107.47 255.81 87.7603 249.26C32.6403 230.94 -2.94973 178.37 0.190275 120.27C3.53027 58.4501 52.5803 6.9701 114.11 0.700098C183.3 -6.3499 244.07 40.6301 254.6 109.51C256.23 120.2 256.83 131.03 254.85 141.81V141.81Z" fill="#E11B1B"/>
                                    <path d="M254.851 141.81C253.901 157.47 249.211 172.11 241.971 185.85C222.701 222.45 192.591 244.9 152.181 253.57C150.901 253.85 149.551 253.82 148.231 253.94C145.631 253.93 143.601 252.98 141.691 251.05C121.101 230.32 100.401 209.7 79.8109 188.98C79.0309 188.19 76.6309 187.69 78.2509 185.61C78.3609 185.58 78.471 185.55 78.581 185.51C85.011 183.79 89.421 179.22 93.911 174.65C103.951 164.44 114.101 154.34 124.281 144.26C128.391 140.18 129.551 140.18 133.721 144.32C144.961 155.46 156.111 166.68 167.301 177.86C168.361 178.92 169.391 180.01 170.501 181.02C174.681 184.83 179.601 185.14 183.031 181.84C186.531 178.46 186.521 172.88 182.621 168.86C172.881 158.82 162.871 149.04 153.001 139.13C151.001 137.13 148.991 135.13 146.991 133.12C141.341 127.44 141.331 127.19 146.851 121.66C156.381 112.11 165.821 102.47 175.501 93.0802C180.591 88.1502 185.511 83.2702 186.471 75.9102C186.521 75.5802 186.551 75.2502 186.581 74.9102C188.681 75.4402 189.791 77.2202 191.171 78.6002C211.061 98.4402 230.911 118.32 250.781 138.17C252.071 139.45 253.491 140.6 254.851 141.81V141.81Z" fill="#C30606"/>
                                    <path d="M186.59 74.9098C187.91 79.9298 186.29 83.8598 182.62 87.4598C170.4 99.4598 158.43 111.72 146.19 123.7C143.59 126.25 143.08 127.63 146.03 130.49C158.57 142.64 170.82 155.09 183.14 167.46C187.36 171.69 188.23 176.25 185.8 180.48C182.3 186.59 174.86 187.29 169.34 181.82C156.93 169.53 144.51 157.25 132.36 144.72C129.44 141.71 127.98 141.78 125.1 144.75C113.17 157.04 100.91 169.01 88.8705 181.2C85.8805 184.23 82.5405 185.95 78.2505 185.62C68.6605 181.06 67.5405 174.17 75.2105 166.49C87.3205 154.35 99.3805 142.15 111.65 130.17C114.22 127.66 114 126.36 111.57 123.97C98.8505 111.49 86.3205 98.8298 73.7205 86.2298C70.1505 82.6498 69.0905 78.4998 71.5605 73.9798C73.7705 69.9098 77.4505 68.2598 82.0605 68.8998C84.8505 69.2898 86.8105 71.0798 88.7205 72.9998C100.71 85.0298 112.83 96.9298 124.67 109.11C127.65 112.18 129.28 112.74 132.58 109.3C144.34 97.0498 156.48 85.1698 168.52 73.1898C175.19 66.5498 181.31 67.1798 186.6 74.9198L186.59 74.9098Z" fill="#FEFEFE"/>
                                 </g>
                                 <defs>
                                    <clipPath id="clip0_2088_553">
                                       <rect width="256.1" height="255.86" fill="white"/>
                                    </clipPath>
                                 </defs>
                              </svg>
                           </a>
                           <img src="" class="d-none" width="80%" id="profileImage">
                           <div class="thumb_nails  ">
                              <svg width="60" height="55" viewBox="0 0 60 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <g clip-path="url(#clip0_1530_2037)">
                                    <path d="M22.5254 17.5197C19.7293 17.5384 17.4868 15.2828 17.508 12.4738C17.5291 9.72349 19.7739 7.49601 22.5042 7.51242C25.2487 7.52883 27.4583 9.75631 27.4607 12.5137C27.4653 15.2734 25.2675 17.5009 22.5254 17.5197Z" fill="#F7F9FA"/>
                                    <path d="M53.9481 0.00940304C41.2932 -0.00232054 28.6383 -0.00232054 15.9834 0.00940304C12.7956 0.0117478 10.7361 1.72339 10.0277 4.86296C9.66651 5.85478 9.80021 6.87708 9.82601 7.88999C9.80021 8.59575 9.78379 9.30151 9.76972 10.0073C9.74391 10.0917 9.70404 10.1714 9.65009 10.2488C8.90416 11.2922 8.64848 12.5138 8.34589 13.7096C7.82515 15.7682 7.07688 17.7706 6.77195 19.8856C5.20504 19.9254 4.68899 20.2724 4.32072 21.6769C2.92739 26.9924 1.52233 32.3008 0.185292 37.6257C-0.586435 40.7066 1.10714 43.5648 4.13306 44.4722C4.84146 44.6856 5.56158 44.8591 6.27701 45.0514C18.3197 48.2801 30.36 51.5158 42.4051 54.7374C45.9729 55.6917 48.8533 53.9871 49.7963 50.3833C50.181 48.9131 50.4695 47.4172 50.9011 45.9611C51.253 44.7724 50.9903 43.9001 49.9253 43.2694C49.93 42.1486 50.4038 41.131 50.6314 40.0595C51.7245 40.0454 52.8175 40.0267 53.9106 40.022C57.652 40.0056 59.993 37.696 59.9953 33.9796C60.0023 24.6875 60.0023 15.3954 59.9953 6.10332C59.993 2.37757 57.6707 0.0140925 53.9481 0.00940304V0.00940304ZM13.7527 29.7709C13.7527 21.9606 13.7503 14.1504 13.7527 6.34248C13.7527 4.32368 14.3133 3.75626 16.3118 3.75626C28.7744 3.75391 41.2369 3.75391 53.6972 3.75626C55.6253 3.75626 56.2446 4.36823 56.2446 6.25807C56.2493 12.2699 56.2469 18.2841 56.2469 24.2983V25.473C53.8309 22.6594 51.6095 20.0684 49.3858 17.4799C48.6235 16.5912 47.8799 15.6838 47.0917 14.8186C45.1472 12.6873 42.2245 12.7131 40.3526 14.9195C37.5777 18.195 34.8473 21.5128 32.0982 24.8118C31.7768 25.1963 31.4461 25.5738 31.0684 26.017C30.0762 25.0041 29.1661 24.038 28.2161 23.1119C26.2481 21.1939 23.7148 21.1728 21.7585 23.1049C19.1501 25.677 16.5839 28.2961 13.7527 31.1449V29.7709V29.7709Z" fill="#F7F9FA"/>
                                    <path d="M22.5254 17.5197C19.7293 17.5384 17.4868 15.2828 17.508 12.4738C17.5291 9.72349 19.7739 7.49601 22.5042 7.51242C25.2487 7.52883 27.4583 9.75631 27.4607 12.5137C27.4653 15.2734 25.2675 17.5009 22.5254 17.5197Z" fill="black"/>
                                    <path d="M53.9484 0.00940304C41.2934 -0.00232054 28.6385 -0.00232054 15.9836 0.00940304C12.7958 0.0117478 10.7363 1.72339 10.028 4.86296C9.9224 5.86885 9.86376 6.87708 9.82622 7.88999C9.80042 8.59575 9.784 9.30151 9.76993 10.0073C9.7582 10.5442 9.74882 11.0765 9.73709 11.6087C9.55882 19.3697 9.66437 27.1354 9.66906 34.8988C9.67141 35.7382 9.87314 36.5002 10.3071 37.2318C11.5784 39.3748 13.462 40.4065 15.9273 40.4089C26.9731 40.4182 38.0189 40.4135 49.0647 40.4089C49.6112 40.4089 50.1648 40.4229 50.6316 40.0595C51.7247 40.0454 52.8177 40.0267 53.9108 40.022C57.6522 40.0056 59.9932 37.696 59.9955 33.9796C60.0025 24.6875 60.0025 15.3954 59.9955 6.10332C59.9932 2.37757 57.6709 0.0140925 53.9484 0.00940304V0.00940304ZM13.7529 29.7709C13.7529 21.9606 13.7505 14.1504 13.7529 6.34248C13.7529 4.32368 14.3135 3.75626 16.312 3.75626C28.7746 3.75391 41.2371 3.75391 53.6974 3.75626C55.6255 3.75626 56.2448 4.36823 56.2448 6.25807C56.2495 12.2699 56.2471 18.2841 56.2471 24.2983V25.473C53.8311 22.6594 51.6097 20.0684 49.386 17.4799C48.6237 16.5912 47.8801 15.6838 47.092 14.8186C45.1474 12.6873 42.2247 12.7131 40.3528 14.9195C37.5779 18.195 34.8475 21.5128 32.0984 24.8118C31.777 25.1963 31.4463 25.5738 31.0687 26.017C30.0764 25.0041 29.1663 24.0381 28.2163 23.1119C26.2483 21.1939 23.715 21.1728 21.7587 23.1049C19.1503 25.677 16.5841 28.2961 13.7529 31.1449V29.7709V29.7709Z" fill="black"/>
                                    <path d="M50.6313 40.0594C50.4037 41.131 49.9299 42.1486 49.9252 43.2694C48.2481 43.4616 47.5842 44.5449 47.3239 46.083C47.1432 47.1569 46.8266 48.2097 46.5357 49.2625C45.9704 51.3211 45.0509 51.8885 42.9914 51.3399C36.0529 49.4922 29.1144 47.6329 22.1782 45.7735C17.1256 44.4206 12.0707 43.0818 7.02048 41.7172C6.49271 41.5741 5.95789 41.4639 5.4395 41.281C3.72246 40.6808 3.17592 39.7218 3.61691 37.9328C4.71234 33.5013 5.89925 29.0909 7.06271 24.6781C7.50135 23.0134 8.12764 21.4096 6.77184 19.8855C7.07678 17.7706 7.82505 15.7682 8.34579 13.7095C8.64838 12.5137 8.90406 11.2921 9.64998 10.2487C9.70393 10.1714 9.74381 10.0916 9.76961 10.0096C9.76961 10.0096 9.77196 10.0096 9.76961 10.0072C9.89863 9.62269 9.77196 9.17719 9.80714 8.76921C9.83295 8.47612 9.83295 8.18303 9.82591 7.88994C9.80011 6.87703 9.6664 5.85473 10.0276 4.86292C10.0206 14.5044 10.0089 24.1435 10.0159 33.785C10.0183 34.9714 9.9385 36.1367 10.7266 37.2458C12.0355 39.0887 13.7057 40.0266 15.9552 40.0243C27.0854 40.0172 38.2156 40.0243 49.3458 40.0243C49.7751 40.0243 50.202 40.0477 50.6313 40.0618V40.0594Z" fill="#D4D9DB"/>
                                    <path d="M50.9011 45.9611C50.4695 47.4172 50.181 48.9131 49.7963 50.3832C48.8533 53.987 45.9729 55.6917 42.4051 54.7374C30.36 51.5157 18.3197 48.28 6.27701 45.0513C5.56158 44.8591 4.84146 44.6856 4.13306 44.4722C1.10714 43.5648 -0.586435 40.7066 0.185292 37.6256C1.52233 32.2984 2.92739 26.99 4.32072 21.6769C4.68899 20.2724 5.20504 19.9254 6.77195 19.8855C8.13009 20.8164 8.30367 21.2923 7.87676 22.9313C6.55145 28.0217 5.21911 33.1074 3.89849 38.1977C3.49973 39.7359 3.98294 40.5495 5.54281 40.9668C18.1508 44.3432 30.7612 47.7149 43.3715 51.0819C44.99 51.5134 45.7571 51.0351 46.1769 49.3797C46.5499 47.9072 46.9111 46.4324 47.2958 44.9622C47.6922 43.4405 48.4053 42.9903 49.9253 43.2693C50.9903 43.9001 51.253 44.7723 50.9011 45.9611V45.9611Z" fill="black"/>
                                    <path d="M27.4607 12.5161C27.4653 15.2759 25.2675 17.5034 22.5254 17.5221C19.7293 17.5409 17.4868 15.2852 17.508 12.4763C17.5291 9.72593 19.7739 7.49845 22.5042 7.51486C25.2487 7.53127 27.4583 9.75875 27.4607 12.5161V12.5161Z" fill="#EBEEF0"/>
                                    <path d="M32.5415 30.1647C35.9779 26.024 39.4237 21.8902 42.8414 17.7354C43.4489 16.9968 43.911 16.8585 44.5936 17.6604C48.3068 22.0309 52.0528 26.371 55.7778 30.7321C56.4369 31.5059 56.4721 34.7393 55.8645 35.5271C55.4541 36.0593 54.8981 36.2774 54.2273 36.2751C49.1137 36.2586 43.9978 36.2516 38.8842 36.2422C38.2509 35.9913 37.8169 35.4872 37.3572 35.0183C35.7645 33.3887 34.0943 31.8365 32.5439 30.1671L32.5415 30.1647Z" fill="#86BF22"/>
                                    <path d="M32.5413 30.1648C32.7501 30.2539 33.0128 30.2891 33.1606 30.4391C35.077 32.3641 36.977 34.3032 38.8817 36.2399C31.1902 36.2493 23.4987 36.2611 15.8073 36.2728C15.3663 36.2728 14.8221 36.2775 14.6321 35.907C14.3834 35.424 14.9863 35.1989 15.2607 34.9222C18.174 31.9843 21.1343 29.0909 24.0148 26.1202C24.8029 25.3065 25.3025 25.4027 26.0039 26.1483C27.1814 27.398 28.4176 28.5938 29.6397 29.799C30.6765 30.8213 31.2183 30.8799 32.5413 30.1601V30.1648Z" fill="#94CD31"/>
                                    <path d="M27.4607 12.5161C27.4653 15.2759 25.2675 17.5034 22.5254 17.5221C19.7293 17.5409 17.4868 15.2852 17.508 12.4763C17.5291 9.72593 19.7739 7.49845 22.5042 7.51486C25.2487 7.53127 27.4583 9.75875 27.4607 12.5161V12.5161Z" fill="black"/>
                                    <path d="M23.7103 12.5255C23.6563 13.2828 23.2482 13.7611 22.4717 13.7518C21.7 13.7424 21.2637 13.2687 21.2731 12.4856C21.2825 11.7447 21.7516 11.3179 22.4389 11.2992C23.1895 11.2781 23.6516 11.7212 23.7079 12.5278L23.7103 12.5255Z" fill="#F9BD07"/>
                                 </g>
                                 <defs>
                                    <clipPath id="clip0_1530_2037">
                                       <rect width="60" height="55" fill="white"/>
                                    </clipPath>
                                 </defs>
                              </svg>
                              <h4>Add New Image</h4>
                           </div>
                           <input type="file"  accept="image/*" name="profile_picture" id="profile_picture" class="">  
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="first_name">First Name<span class="text-danger"> *</span></label>
                           <input type="text" name="first_name" class="form-control" id="first_name" maxlength="100">
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="last_name">Last Name </label>
                           <input type="text" name="last_name" class="form-control" id="last_name" maxlength="100">                 
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label for="email">Email<span class="text-danger"> *</span></label>
                           <input type="email" name="email" class="form-control" id="email" value=""maxlength="100">                 
                           <div id ="email_error" class="error"></div>
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="form-group">
                           <label for="password">Contact Number<span class="text-danger"> *</span></label>
                           <br>
                           <input type="tel"  name="phone_number" class="form-control"  id="txtPhone"  autocomplete="false" />
                           <input type="hidden"  name="country_code" class="form-control"  id="country_code" /> 
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="form-group">
                           <label for="password">Password<span class="text-danger"> *</span></label>
                           <input type="password" name="password" class="form-control" id="password" maxlength="100"  >
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="form-group">
                           <label for="confirm_password">Confirm Password<span class="text-danger"> *</span></label>
                           <input type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100"  >
                        </div>
                     </div>
                     
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Gender <span class="text-danger"> *</span> </label>
                           <select class="form-control"  name="gender">
                              <option value="" >Select Gender</option>
                              <option  value="1">Male</option>
                              <option  value="2">Female</option>
                              <option  value="3">Transgender</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                           <label>Preferred Language <span class="text-danger"> *</span> </label>
                           <select class="form-control" name="preferred_lang">
                              <option value="">Select Language</option>
                              <option value="1">English</option>
                              <option value="2">Spanish</option>
                              <option value="3" >Chinesh</option>
                              <option value="4">Portuguese</option>
                              <option value="5">Arbic</option>
                              <option value="6">Hindi</option>
                           </select>
                        </div>
                     </div>
                     
                  <div class="card-footer text-left">
                     <button type="text" class="btn btn-primary common_btn addagent_btn">{{ __('adminlte::adminlte.save') }}</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>



@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />

<style>
 .profile-image-show{
        position: relative;
 }

 #profile_picture{
     border:1px solid red;
     width:100% !important;
     height:100% !important;
     border-radius:20%;
     position:absolute;
     opacity:0;
     
  }
</style>

@stop

@section('js')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script type="text/javascript">
  $(function () {
      var code = "+91";  
      $('#txtPhone').val(code);
      $('#txtPhone').intlTelInput({
          autoHideDialCode: true,
          autoPlaceholder: "ON",
          dropdownContainer: document.body,
          formatOnDisplay: true,
           
          initialCountry: "auto",
          nationalMode: true,
          placeholderNumberType: "MOBILE",
          preferredCountries: ['US'],
          separateDialCode: true
      });
     


       
  });

  $("#txtPhone").on('focusout',function(){
    var code = $("#txtPhone").intlTelInput("getSelectedCountryData").dialCode;
     $('#country_code').val(code);
  });

</script>


  <script>
    $(document).ready(function() {

        $("input").attr("autocomplete", "new-password");
    

    
      //Validator
  $('#addUser').validate({
ignore: [],
debug: false,
rules: {
profile_picture :{
accept: "jpg|jpeg|png|ico|bmp", 
},
first_name: {
required: true,
maxlength: 100,
alpha:true,
},
last_name: {
maxlength: 100,
alpha:true,
},
email:{
required:true,
email:true,
remote:{
type:"post",
url:"{{route('marketting.check_user_email')}}",
data: {
"email": function() { return $("#email").val(); },
"_token": "{{ csrf_token() }}",
},
dataFilter: function (result) {
var json = JSON.parse(result);
if (json.msg == 1) {
return "\"" + "Email ID already  exist" + "\"";
} else {
return 'true';
}
}    
}
},
phone_number: {
required:true,
phone_valid:true,
},
password: {
required: true,
minlength: 8
},
confirm_password: {
required: true,
minlength: 8,
equalTo : "#password"
},
dob:{
required:true,
},
gender: {
required: true
},
preferred_lang   : {
required: true
},
 
},
messages: {
profile_picture :{
required: "Profile Picture required"
},
first_name: {
required: "Name is required"
},
email:{
required:"Email is required",
},
phone_number:{
required:"Contact Number is required",
},
password: {
required: "The Password is required",
minlength: "Minimum length should be 8"
},
confirm_password: {
required: "The Confirm Password is required",
minlength: "Minimum length should be 8",
equalTo : "The Confirm Password must be equal to Password"
},
gender:{
required: "Please select gender",
},
preferred_lang:{
required : "Please select language",
},
 
}
});
 

jQuery.validator.addMethod("phone_valid", function(value, element) { 
return this.optional(element) || /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(value)
// just ascii letters
},"Please enter vaild numer");
jQuery.validator.addMethod("alpha", function(value, element) { 
return this.optional(element) || /^[a-zA-Z ]*$/.test(value)
// just ascii letters
},"Please use alphabets only");
         
      
    });






$('#profile_picture').on('change',function(){
           var files = this.files[0];
        
        if(files.size > 2010000){

            swal({
            title: "Error",
            text: "The file is too large. Allowed maximum size is 2MB.",
            type: "warning",
            showCancelButton: true,
            });

          this.value =null;
           

        }else{
           var blob_url = URL.createObjectURL(event.target.files[0]);
        $('#profileImage').attr('src', blob_url);
        $("#profileImage").removeClass("d-none");
        $(".thumb_nails").addClass("d-none");
        $("#profile_picture").addClass("d-none");
        $(".remove-pro-img").removeClass("d-none");
        } 
    });





$(".remove-pro-img").click(function(evt){      
   
                  $(".remove-pro-img").addClass("d-none");
                  $("#profileImage").addClass("d-none");
                  $(".thumb_nails").removeClass("d-none");
                  $("#profile_picture").removeClass("d-none");
                $("#profile_picture").val(null);  
    
 
  });


  </script>
@stop
