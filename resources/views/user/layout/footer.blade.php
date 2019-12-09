
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row menu">
                    @php 
                        foreach ($nav_section as $key => $item):
                        if($key==0) continue;
                        if($key == 5 ) break;
                    @endphp
                    <div class="col-md-3 col-6">
                        <h6> {{ $item->name }} </h6>
                        <ul>
                            @php 
                                foreach($item->child_category as $k => $val):
                                if($k == 4 ) break;
                            @endphp
                             <li>  <a href="{{ route('danhmuc',$val->slug) }}"> {{ $val->name }}  </a> </li>
                            @php
                                endforeach;
                            @endphp
                        </ul>
                    </div>
                   
                    @php 
                        endforeach;
                    @endphp 
                </div>
            </div>
            
            <div class="col-md-3 ">
                <div class="social">
                    <h6> Liên kết </h6>
                    <ul> 
                        <li> <a target="_blank" href="https://www.facebook.com/baotuyensinh/"> <i class="fa fa-facebook"></i> </a> </li>
                        <li> <a target="_blank" href=""> <i class="fa fa-twitter"></i> </a> </li>
                        <li> <a target="_blank" href=""> <i class="fa fa-google-plus"></i> </a> </li>
                        <li> <a target="_blank" href="https://www.youtube.com/channel/UC6RxJoDPb9GilhZucQvLTVQ"> <i class="fa fa-youtube"></i> </a> </li>
                    </ul>
                    <ul class="app">
                        <li> <img src="{{ asset('media/google-play-badge.png') }}" alt="logo" />  </li>
                        <li> <img src="{{ asset('media/app store badge.png') }}" alt="logo" />  </li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="copyright">
            <div class="row">
                <div class="col-md-6">
                    <p> © Copyright 2019 Web Tuyển Sinh. All rights reserved. <br /> 

                        Giấy phép số 196/GP-BTTTT do Bộ Thông Tin Truyền Thông cấp ngày 21/05/2019 </p>
                </div>
                <div class="col-md-6">
                    <p class="right">
                        <b> Liên hệ tòa soạn </b> <br />
                        Hotline: 1900 272786 - Email: lienhe@bts.edu.vn 
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
