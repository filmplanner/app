<template>
    <nav id="mainNav" class="navbar fixed-top navbar-toggleable-md navbar-inverse bg-inverse">
        <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="../assets/logo-mobile.png" alt="Film Planner"></a>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="sidebar-nav navbar-nav">
                <li class="nav-item nav-logo hidden-md-down">
                  <a href="#"><img src="../assets/logo.png" alt="Film Planner"></a>
                </li>
                <router-link tag="li" class="nav-item" to="/" exact-active-class="active">
                  <a class="nav-link"><i class="fa fa-fw fa-calendar-o"></i> Plannen</a>
                </router-link>
                 <li class="nav-item">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMovies"><i class="fa fa-fw fa-film"></i> Films</a>
                    <ul class="sidebar-second-level collapse" id="collapseMovies">
                      <router-link tag="li" to="/films/actueel" exact-active-class="active">
                        <a class="nav-link">Actueel</a>
                      </router-link>
                      <router-link tag="li" to="/films/verwacht" exact-active-class="active">
                        <a class="nav-link">Verwacht</a>
                      </router-link>
                    </ul>
                </li>
                <router-link tag="li" class="nav-item" to="/bioscopen" exact-active-class="active">
                  <a class="nav-link"><i class="fa fa-fw fa-building-o"></i> Bioscopen</a>
                </router-link>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                  <a class="nav-link mr-lg-2" href="#">
                    <i class="fa fa-fw fa-bell"></i> <span class="hidden-lg-up">Meldingen <span class="badge badge-pill badge-primary">1 nieuw</span></span>
                    <span class="new-indicator text-primary hidden-md-down"><i class="fa fa-fw fa-circle"></i><span class="number">1</span></span>
                  </a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle mr-lg-2" href="#" id="alertsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user"></i> Wesley
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-cog"></i> Instellingen</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-fw fa-sign-out"></i> Uitloggen</a>
                  </div>
                </li>
            </ul>
        </div>
    </nav>
</template>

<style lang="scss">
/*!
 * Start Bootstrap - SB Admin v4.0.0-alpha (http://startbootstrap.com/template-overviews/sb-admin)
 * Copyright 2013-2017 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-sb-admin/blob/master/LICENSE)
 */

$bg-color: #fff;
$bg-color-dark: #171819;
$nav-bg-color: #FFBD31;
$nav-bg-color-hover: #FFCF67;
$nav-bg-color-active: #DFA424;
$nav-sub-bg-color: #FFBD31;
$nav-text-color: #171819;
$nav-text-color-hover: white;
$nav-text-color-active: white;

.bg-inverse {
  background: $bg-color-dark !important;
}

.navbar-brand {
  text-align: center;
}

.nav-logo {
  background: $bg-color-dark;
  text-align: center;
  padding: 30px 0px !important;
}

#mainNav .navbar-collapse {
  overflow: hidden;
  max-height: 75vh; 
}

.navbar-inverse .navbar-toggler {
  border: none;
  outline: none;
  padding: 7px 0px;
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .nav-link-collapse:after {
  font-family: 'FontAwesome';
  float: right;
  content: '\f107';
  color: $nav-text-color; 
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .nav-link-collapse.collapsed:after {
  content: '\f105'; 
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-second-level,
#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-third-level {
  padding-left: 0; 
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-second-level > li > a,
#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-third-level > li > a {
  display: block;
  padding: .5em 0;
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-second-level > li > a:focus, #mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-second-level > li > a:hover,
#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-third-level > li > a:focus,
#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-third-level > li > a:hover {
  text-decoration: none;
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-second-level > li > a {
  padding-left: 1em; 
}

#mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-third-level > li > a {
  padding-left: 2em; 
}
#mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown > .nav-link {
  position: relative;
  min-width: 45px; 
}

#mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown > .nav-link:after {
  font-family: 'FontAwesome';
  float: right;
  width: auto;
  content: '\f105';
  color: #464a4c;
  border: none; 
}

#mainNav .navbar-collapse .navbar-nav > .nav-item > .nav-link .new-indicator {
  font-size: 1.1rem;
  position: absolute;
  top: 0;
  right: 25px; 
}

#mainNav .navbar-collapse .navbar-nav > .nav-item > .nav-link .new-indicator .number {
  font-size: .6rem;
  position: absolute;
  top: 6px;
  left: 0;
  width: 22.625px;
  text-align: center;
  color: white;
}
  
#mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown.show > .nav-link:after {
  content: '\f107'; 
}

#mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown .dropdown-menu > .dropdown-item > .dropdown-message {
  overflow: hidden;
  max-width: none;
  text-overflow: ellipsis; 
}

@media (min-width: 992px) {
  #mainNav .navbar-brand {
    width: 250px; 
  }

  #mainNav .navbar-collapse {
    overflow: visible;
    max-height: none; 
  }
  
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav {
    position: absolute;
    top: 0;
    left: 0;
    overflow: hidden;
    flex-direction: column;
    height: 100vh;
    background: $nav-bg-color;
    -webkit-flex-direction: column;
    -ms-flex-direction: column; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item {
    width: 250px;
    padding: 0; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item > .nav-link {
    padding: 1em; 
    color: $nav-text-color;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item:not(.active) > .nav-link:hover {
    background: $nav-bg-color-hover;
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-second-level,
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-third-level {
    padding-left: 0;
    list-style: none;
    background: $nav-sub-bg-color; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-second-level > li,
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-third-level > li {
    width: 250px; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-second-level > li > a,
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-third-level > li > a {
    padding: 1em; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-second-level > li > a,
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav .sidebar-third-level > li > a {
    color: $nav-text-color !important; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-second-level > li > a {
    padding-left: 2em; 
  }
  
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-third-level > li > a {
    padding-left: 3em; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-second-level > li:not(.active) > a:hover,
  #mainNav .navbar-collapse .navbar-nav.sidebar-nav > .nav-item .sidebar-third-level > li:not(.active) > a:hover {
    background: $nav-bg-color-hover;
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav li.active a {
    color: $nav-text-color-active !important;
    background-color: $nav-bg-color-active; 
  }

  #mainNav .navbar-collapse .navbar-nav.sidebar-nav li.active a:hover, #mainNav .navbar-collapse .navbar-nav.sidebar-nav li.active a:focus {
    color: $nav-text-color; 
  }

  #mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown > .nav-link {
    min-width: 0; 
  }

  #mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown > .nav-link:after {
    width: 24px;
    text-align: center; 
  }
  
  #mainNav .navbar-collapse .navbar-nav > .nav-item.dropdown .dropdown-menu > .dropdown-item > .dropdown-message {
    max-width: 300px; 
  }    
}

</style>
