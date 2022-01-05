<html>
 <head>
  <title>Prueba de PHP</title>
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
 </head>
 <body>
 <center>
 <h2>Login</h2>
    <form id = "login" method = "post" >  
    <div style="margin:20px 0;"></div>
    <div class="easyui-panel" style="width:400px;padding:50px 60px">
        <div style="margin-bottom:20px">
            <input id="usuario" name='usuario' class="easyui-textbox" prompt="Usuario" iconWidth="28" iconCLS ="icon-man" style="width:100%;height:34px;padding:10px;">
        </div>
        <div style="margin-bottom:20px">
            <input id="contraseña" name='contraseña'class="easyui-passwordbox" prompt="Contraseña" iconWidth="28" iconCLS ="icon-lock" style="width:100%;height:34px;padding:10px">
        </div>
        <center>
        <div style="margin-bottom:20px">
        <!-- <a href = "javascript:void(0)" class = "easyui-linkbutton c6" iconCls = "icon-ok" onclick = "saveUser ()" style = "width: 90px"> Guardar </a> -->
        <button id="ingresar" class = "easyui-linkbutton c1" type="submit" onclick = "validar()" style = "width: 90px"> Ingresar </a>
        </div>
        </center>
    </div>
    </form>
</center>
 </body>
 <script src="login.js"></script>
</html>




