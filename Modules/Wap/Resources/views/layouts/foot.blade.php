<footer>
    <div class="footCont">
        <ul>
            <li @if(\Request::path()=='wap')class="on"@endif>
                <a href="{{url('/wap')}}">
                    <i class="footIcon icon-home"></i>
                    <p>首页</p>
                </a>
            </li>
            <li @if(strpos(\Request::path(),'/category'))class="on"@endif>
                <a href="{{url('/wap/category')}}">
                    <i class="footIcon icon-type "></i>
                    <p>分类</p>
                </a>
            </li>
            <li @if(strpos(\Request::path(),'/car'))class="on"@endif>
                <a href="{{url('/wap/car')}}">
                    <i class="footIcon icon-buy "></i>
                    <p>购物车</p>
                </a>
            </li>
            <li @if(strpos(\Request::path(),'/user'))class="on"@endif>
                <a href="{{url('/wap/user')}}">
                    <i class="footIcon icon-my "></i>
                    <p>我的</p>
                </a>
            </li>
        </ul>
    </div>
</footer>