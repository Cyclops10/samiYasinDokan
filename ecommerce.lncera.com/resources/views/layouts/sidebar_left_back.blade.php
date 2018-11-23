<aside id="sidebar-left" class="sidebar-left">

				    <div class="sidebar-header">
				        <div class="sidebar-title">
				            Navigation
				        </div>
				        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>

				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">

				                <ul class="nav nav-main">
				                    <li>
				                        <a class="nav-link" href="/admin/dashboard">
				                            <i class="fa fa-home" aria-hidden="true"></i>
				                            <span>Dashboard</span>
				                        </a>
				                    </li>
				                    <li>
                                        <a class="nav-link" href="/admin/category">
                                            <i class="fa fa-align-left" aria-hidden="true"></i>
                                            <span>Add Category</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="/admin/element">
                                            <i class="fa fa-align-left" aria-hidden="true"></i>
                                            <span>Add Element</span>
                                        </a>
                                    </li>
                                    <li class="nav-parent">
                                        <a class="nav-link" href="/admin/product">
                                            <i class="fa fa-align-left" aria-hidden="true"></i>
                                            <span>Product</span>
                                        </a>
                                        <ul class="nav nav-children" style="">
                                            <li>
                                                <a href="/admin/product/add">
                                                    Add Product
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
				                </ul>
				            </nav>
				        </div>

				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>


				    </div>

				</aside>