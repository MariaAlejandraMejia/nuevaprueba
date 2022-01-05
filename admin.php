
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

    <table id="dg" title="My Users" class="easyui-datagrid" style="width:100%;height:100%"
            url="get_users.php"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true"></table>

    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Usuario</a>
    </div>


    <div id="edit" class="easyui-window" style = " width :50% ; height : 55% " data-options="closed:true,modal:true,border:'thin',iconCls: 'icon-save'">
        <form id="fm1" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>User Information</h3>
            <div style="margin-bottom:10px">
                <input id="nombre" name="nombre" class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input  id="Puesto" name="Puesto" class="easyui-textbox" required="true" label="Puesto:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input  id="usuario" name="usuario" class="easyui-textbox" required="true" label="Usuario:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input  id="contraseña" name="contraseña" class="easyui-textbox" required="true"  label="Contraseña:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
            <select   id="estado" name="estado"  required="true"  label="Estado:" class="easyui-combobox" data-options="valueField:'TIPO',textField:'EST_NOM',url:'http://localhost:3000/usuario/obtener/Estado'" style="width:100%">
            <option value="1">activo</option>
            <option value="2">inactivo</option>
            </select>
            </div>
            <div style="margin-bottom:10px">
            <select  id="tipo" name="tipo"  required="true"  label="Tipo:" class="easyui-combobox" data-options="valueField:'TIPO',textField:'NOMBRE',url:'http://localhost:3000/usuario/obtener/Tipo'" style="width:100%">
            <option value="1">administrador</option>
            <option value="2">operador</option>
            <option value="3">Invitado</option>
            </select>
            </div>
            <div >
                <center>
                <a class = "easyui-linkbutton c5" onclick = "closededit()" style = "width: 90px"> Cancelar </a>
                <a class = "easyui-linkbutton c1" onclick = "guardareditar()" style = "width: 90px"> Registrar </a>
                </center>
            </div>
        </form>
        
    </div>



<script src="admin.js"></script>

<script>
        $('#dg').datagrid({
        singleSelect: true,
        required:true,
        method: 'GET',
        url:'http://localhost:3000/usuario/obtener',
        columns:[[
            {field:'ID_USUARIO',title:'ID',width:'5%',align:'center'},
            {field:'NOMBRE',title:'Nombre',width:'20%',align:'center'},
            {field:'Puesto',title:'Puesto',width:'10%',align:'center'},
            {field:'usuario',title:'Usuario',width:'25%',align:'center'},
            {field:'clave',title:'Contraseña',width:'20%',align:'center'},
            {field:'id_estado',title:'Estado',width:'10%',align:'center'},
            {field:'ID_TIPO_US',title:'Tipo de usuario',width:'10%',align:'center'},
        ]]
        });
        

    function newUser(){
    $('#dlg').window('open').dialog('center');
    
    }


    function closededit(){
    $('#edit').window('close');
    $('#fm1').form('reset');
    }

    function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                /* $('#fm').form('load',row); */
                url = 'http://localhost:3000/usuario/obtener/infopodg/'+row.ID_USUARIO;
                console.log(url)
                $.ajax({
                    url: url,
                    type: 'GET',
                    async: false,
                    cache: false,
                    success: function (respuesta) {
                    console.log(respuesta);
                    NOMBRE = respuesta.NOMBRE;
                    console.log('prueba',NOMBRE);
                    Puesto = respuesta.Puesto;
                    console.log('prueba',Puesto);
                    usuario = respuesta.usuario;
                    console.log('prueba',usuario);
                    clave = respuesta.clave;
                    console.log('prueba',clave);
                    ID_TIPO_US = respuesta.ID_TIPO_US;
                    console.log('prueba',ID_TIPO_US);
                    id_estado = respuesta.id_estado;
                    console.log('prueba',id_estado);
                    },
                    error: function (respuesta) {
                    console.log('fallo info usuario dg');
                    }
                    });
            }

            $('#nombre').textbox('setValue',row.NOMBRE);
            $('#Puesto').textbox('setValue',row.Puesto);
            $('#usuario').textbox('setValue',row.usuario);
            $('#contraseña').textbox('setValue',row.clave);
            $('#tipo').textbox('setValue',row.ID_TIPO_US);
            $('#estado').textbox('setValue',row.id_estado);
            $('#edit').window('open').dialog('center');

        }

    
        
    function guardareditar(){
            var nombre = $('#nombre').textbox('getText');
            console.log(nombre);
            var Puesto = $('#Puesto').textbox('getText');
            console.log(Puesto);
            var usuario = $('#usuario').textbox('getText');
            console.log(usuario);
            var contraseña = $('#contraseña').textbox('getText');
            console.log(contraseña);
            var tipo = $('#tipo').combobox('getValue');
            console.log(tipo);
            var estado =$('#estado').combobox('getValue');
            console.log(estado);
            var row = $('#dg').datagrid('getSelected');
            if (row){ 
                var ID_USUARIO = row.ID_USUARIO
            }
            console.log(ID_USUARIO);

            var url1 =  'http://localhost:3000/usuario/editar/usuario/'+nombre+'/'+Puesto+'/'+usuario+'/'+contraseña+'/'+tipo+'/'+estado+'/'+ID_USUARIO;
            console.log(url1);

            $.ajax({
                    url: url1,
                    type: 'PUT',
                    async: false,
                    cache: false,
                    success: function (respuesta) {
                    console.log('se edito usuario correctamente');
                    },
                    error: function (respuesta) {
                    console.log('fallo editar usuario usuario dg')
                    }
                    });
                
        $('#edit').window('close');
        $('#fm1').form('reset');
    }
    
</script> 



