<?php
$valor = $_GET["pagina"];
$libros = ControladorLibros::ctrMostrarLibros($valor);
echo'<pre>'; print_r($libros); echo'</pre>';
?>
<div class="container">
    <div class="row sidebar-fila">
        <div class="col-3">
            <div class="sidebar">
                <aside class="">
                    <div class="">
                        <h3>Browse Categories</h3>
                    </div>
                    <div class="">
                        <ul class="list">
                            <li>
                                <a href="#">Frozen Fish</a>
                            </li>
                            <li>
                                <a href="#">Dried Fish</a>
                            </li>
                            <li>
                                <a href="#">Fresh Fish</a>
                            </li>
                            <li>
                                <a href="#">Meat Alternatives</a>
                            </li>
                            <li>
                                <a href="#">Fresh Fish</a>
                            </li>
                            <li>
                                <a href="#">Meat Alternatives</a>
                            </li>
                            <li>
                                <a href="#">Meat</a>
                            </li>
                        </ul>
                    </div>
                </aside>
                <aside class="left_widgets p_filter_widgets">
                    <div class="l_w_title">
                        <h3>Browse Categories</h3>
                    </div>
                    <div class="widgets_inner">
                        <ul class="list">
                            <li>
                                <a href="#">Frozen Fish</a>
                            </li>
                            <li>
                                <a href="#">Dried Fish</a>
                            </li>
                            <li>
                                <a href="#">Fresh Fish</a>
                            </li>
                            <li>
                                <a href="#">Meat Alternatives</a>
                            </li>
                            <li>
                                <a href="#">Fresh Fish</a>
                            </li>
                            <li>
                                <a href="#">Meat Alternatives</a>
                            </li>
                            <li>
                                <a href="#">Meat</a>
                            </li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>    
        <div class="col-9">
            <div class="row">
                <div class="col-4 libros">
                    <img src="views/img/product-5.jpg" alt="">
                    <h3>Cien Años de Soledad</h3>
                    <p>Gabriel Garcia Márquez</p>
                </div>
                <div class="col-4 libros">
                    <img src="views/img/product-5.jpg" alt="">
                    <h3>Cien Años de Soledad</h3>
                    <p>Gabriel Garcia Márquez</p>
                </div>
                <div class="col-4 libros">
                    <img src="views/img/product-5.jpg" alt="">
                    <h3>Cien Años de Soledad</h3>
                    <p>Gabriel Garcia Márquez</p>
                </div>
                <div class="col-4 libros">
                    <img src="views/img/product-5.jpg" alt="">
                    <h3>Cien Años de Soledad</h3>
                    <p>Gabriel Garcia Márquez</p>
                </div>
                <div class="col-4 libros">
                    <img src="views/img/product-5.jpg" alt="">
                    <h3>Cien Años de Soledad</h3>
                    <p>Gabriel Garcia Márquez</p>
                </div>
                <div class="col-4 libros">
                    <img src="views/img/product-5.jpg" alt="">
                    <h3>Cien Años de Soledad</h3>
                    <p>Gabriel Garcia Márquez</p>
                </div>
            </div>
            
            <div class="page-btn">
                <span>1</span>
                <span>2</span>
                <span>3</span>
                <span>&#8594;</span>
            </div>
        </div>
    </div>
</div>
