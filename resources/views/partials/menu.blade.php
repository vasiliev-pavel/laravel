<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Информационная панель</span>
                    </a>
                </li>

                {{--Manage Students--}}
                @if(Qs::userIsTeamSAT())
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.create', 'students.list', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span>Ученики</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        {{--Admit Student--}}
                        @if(Qs::userIsTeamSA())
                        <li class="nav-item">
                            <a href="{{ route('students.create') }}" class="nav-link {{ (Route::is('students.create')) ? 'active' : '' }}">Добавить ученика</a>
                        </li>
                        @endif

                        {{--Student Information--}}
                        <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'nav-item-expanded' : '' }}">
                            <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'active' : '' }}">Информация о учениках</a>
                            <ul class="nav nav-group-sub">
                                @foreach(App\Models\MyClass::orderBy('name')->get() as $c)
                                <li class="nav-item"><a href="{{ route('students.list', $c->id) }}" class="nav-link ">{{ $c->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        @if(Qs::userIsTeamSA())

                        {{--Student Promotion--}}
                        <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'nav-item-expanded' : '' }}"><a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage' ]) ? 'active' : '' }}">Перевод учеников</a>
                            <ul class="nav nav-group-sub">
                                <li class="nav-item"><a href="{{ route('students.promotion') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion']) ? 'active' : '' }}">Управление переводами</a></li>
                                <li class="nav-item"><a href="{{ route('students.promotion_manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion_manage']) ? 'active' : '' }}">Аннулирование переводов</a></li>
                            </ul>

                        </li>

                        {{--Student Graduated--}}
                        <li class="nav-item"><a href="{{ route('students.graduated') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.graduated' ]) ? 'active' : '' }}">Выпускники</a></li>
                        @endif

                    </ul>
                </li>
                @endif

                @if(Qs::userIsTeamSA())
                {{--Manage Users--}}
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}"><i class="fa fa-users" aria-hidden="true"></i><span>Пользователи</span></a>
                </li>

                {{--Manage Classes--}}
                <li class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index','classes.edit']) ? 'active' : '' }}"><i class="icon-windows2"></i> <span>Классы</span></a>
                </li>

                {{--Manage Sections--}}
                <li class="nav-item">
                    <a href="{{ route('sections.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'active' : '' }}"><i class="icon-fence"></i> <span>Управление группами</span></a>
                </li>

                {{--Manage Subjects--}}
                <li class="nav-item">
                    <a href="{{ route('subjects.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'active' : '' }}"><i class="fa fa-university"></i> <span>Предметы</span></a>
                </li>

                {{--Manage Dorms--}}
                    <li class="nav-item">
                        <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="fa fa-book"></i> <span> Секции</span></a>
                    </li>

                @endif

                {{--Exam--}}
                @if(Qs::userIsTeamSAT())
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['tt.index','exams.index', 'exams.edit', 'grades.index', 'grades.edit', 'marks.index', 'marks.manage', 'marks.bulk', 'marks.tabulation', 'marks.show', 'marks.batch_fix',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-books"></i> <span> Проверка знаний</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Управление работами">
                        @if(Qs::userIsTeamSAT())
                        
                        {{--Exam list--}}
                        <li class="nav-item">
                            <a href="{{ route('exams.index') }}" class="nav-link {{ (Route::is('exams.index')) ? 'active' : '' }}">Создание работ</a>
                        </li>
                        @if(Qs::userIsTeamSAT())

                        {{--Timetables--}}
                        <li class="nav-item"><a href="{{ route('tt.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['tt.index']) ? 'active' : '' }}">Расписание работ</a></li>
                       
                        {{--Marks Manage--}}
                        <li class="nav-item">
                            <a href="{{ route('marks.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.index']) ? 'active' : '' }}">Управление оценками</a>
                        </li>
                        @endif
                        {{--Tabulation Sheet--}}
                        <li class="nav-item">
                            <a href="{{ route('marks.tabulation') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.tabulation']) ? 'active' : '' }}">Просмотр оценок</a>
                        </li>
                        @endif
                       

                    </ul>
                </li>
                @endif


                {{--End Exam--}}

                @include('pages.'.Qs::getUserType().'.menu')

                {{--Manage Account--}}
                <li class="nav-item">
                    <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i class="icon-user"></i> <span>Мой аккаунт</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>