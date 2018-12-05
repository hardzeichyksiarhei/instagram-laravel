<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<!-- <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> -->
<li><a href='{{ backpack_url('user') }}'><i class='fa fa-tag'></i> <span>Пользователи</span></a></li>
<li><a href='{{ backpack_url('price-list') }}'><i class='fa fa-tag'></i> <span>Прайс лист</span></a></li>
<li><a href='{{ backpack_url('cheat-category') }}'><i class='fa fa-tag'></i> <span>Категории накруток</span></a></li>
<li><a href='{{ backpack_url('billing') }}'><i class='fa fa-tag'></i> <span>Заявки</span></a></li>
<li><a href='{{ backpack_url('setting') }}'><i class='fa fa-cog'></i> <span>Настройки</span></a></li>
<li><a href='{{ backpack_url('service') }}'><i class='fa fa-tag'></i> <span>Сервисы</span></a></li>
<li><a href='{{ backpack_url('order') }}'><i class='fa fa-tag'></i> <span>Заказы</span></a></li>