
function newdatagrid(){
    $('#dg').datagrid({
        singleSelect: true,
        required:true,
        method: 'get',
        url:'http://localhost:3000/usuario/obtener',
        columns:[[
            {field:'ID_USUARIO',title:'ID',width:'5%',align:'center'},
            {field:'NOMBRE',title:'Nombre',width:'20%',align:'center'},
            {field:'Puesto',title:'Puesto',width:'10%',align:'center'},
            {field:'usuario',title:'Usuario',width:'25%',align:'center'},
            {field:'clave',title:'Contraseña',width:'20%',align:'center'},
            {field:'id_estado',title:'Estado',width:'10%',align:'center'},
            {field:'ID_TIPO_US',title:'Tipo de usuario',width:'10%',align:'center'}
        ]]
    });
} 

function newUser(){
    $('#dlg').window('open').dialog('center');
    $('#fm').form('clear');
    url = 'save_user.php';
}

function editUser(){
    var row = $('#dg').datagrid('getSelected');
    if (row){
        $('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
        $('#fm').form('load',row);
        url = 'update_user.php?id='+row.id;
    }
}