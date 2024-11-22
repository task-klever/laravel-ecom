<ul>
    <li><a href="{{ route('customer.dashboard') }}" class="btn btn-md btn-block btn-dark">{{ DASHBOARD }}</a></li>
	<li><a href="{{ route('customer.order') }}" class="btn btn-md btn-block btn-dark">{{ ORDERS }}</a></li>
	<li><a href="{{ route('customer.profile_change') }}" class="btn btn-md btn-block btn-dark">{{ EDIT_PROFILE }}</a></li>
	<li><a href="{{ route('customer.password_change') }}" class="btn btn-md btn-block btn-dark">{{ EDIT_PASSWORD }}</a></li>
    <li><a href="{{ route('customer.logout') }}" class="btn btn-md btn-block btn-dark">{{ LOGOUT }}</a></li>
</ul>