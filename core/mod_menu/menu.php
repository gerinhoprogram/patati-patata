<link rel="stylesheet" type="text/css" href="core/css/slimmenu/slimmenu.css">
<link rel="stylesheet" type="text/css" href="core/css/slimmenu/reset.css">
<script type="text/javascript" src="core/mod_includes/js/jquery-1.8.3.min.js"></script>

<ul class="slimmenu">
    <li><a href="../index" target="_parent">Home</a></li>
    <li class="has-submenu">
        <a href="../infantil" target="_parent">Fraldas </a>
        <ul style="display: none; height: 160px; padding-top: 0px; margin-top: 0px; padding-bottom: 0px; margin-bottom: 0px;">
            <li class="has-submenu">
                <a href="../bubble.php" target="_parent">Bubble</a>
            </li>
            <li class="has-submenu">
                <a href="../infantil" target="_parent">Cahe</a>
            </li>
            <!-- <li class="has-submenu">
                <a href="../infantil" target="_parent">Peppa Pig</a>
            </li> -->
        </ul>
        <span class="sub-toggle"><i>▼</i></span>
    </li>

    <li><a href="../adulto" target="_parent">Adulto</a></li>
    <li><a href="../higiene_beleza" target="_parent">Higiene e Beleza</a></li>
    <li><a href="../distribuidores" target="_parent">Distribuidores</a></li>
    <li><a href="../sistema/admin/admlogin.aspx" target="_blank">Área do Vendedor</a></li>
    <li><a href="../fale_conosco" target="_parent">Fale Conosco</a></li>
    <li><a href="https://www.lojacahe.com.br/" target="_blank">Loja Online</a></li>
</ul>

<script src="core/mod_includes/js/slimmenu/jquery.slimmenu.min.js"></script>
<script src="core/mod_includes/js/jquery.easing.min.js"></script>
<script>
    jQuery('ul.slimmenu').slimmenu({
        resizeWidth: '1300',
        collapserTitle: ' ',
        easingEffect: 'easeInOutQuint',
        animSpeed: 'medium',
        indentChildren: true,
        childrenIndenter: ''
    });
</script>