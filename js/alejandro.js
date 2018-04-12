$(document).ready(function(){
    
// PAGINA PERSONA
    $('#add_persona').hide();
    // inmueble
    $('#add_empresa').hide();
    
        $('#nuevaPersona').click(function(){
            $('#personas').hide('slow');
            $('#add_persona').show('slow');
        });
        
        $('#CloseAddPersona').click(function(){
            $('#add_persona').hide('slow');
            $('#personas').show('slow');
        });
        // inmuebles
        $('#nuevaEmpresa').click(function(){
            $('#personas').hide('slow');
            $('#add_empresa').show('slow');
        });
        
        $('#CloseAddEmpresa').click(function(){
            $('#add_empresa').hide('slow');
            $('#personas').show('slow');
        });
 
// PAGINA EMPRESA       
    $('#add_empresa').hide();
    
        $('#nuevaEmpresa').click(function(){
            $('#empresa').hide('slow');
            $('#add_empresa').show('slow');
        });
        
        $('#CloseAddEmpresa').click(function(){
            $('#add_empresa').hide('slow');
            $('#empresa').show('slow');
        });
    

// PAGINA PERMISO DE FUNCIONAMIENTO
    $('#AddpermisoFuncionamientoPersona').hide();
    $('#AddpermisoFuncionamientoEmpresa').hide();
    
    
        // persona
        $('#AddPer').click(function(){
            $('#permisoFuncionamiento').hide('slow');
            $('#AddpermisoFuncionamientoPersona').show('slow');
        });
        
        $('#CloseAddPermiso').click(function(){
            $('#AddpermisoFuncionamientoPersona').hide('slow');
            $('#permisoFuncionamiento').show('slow');
        });
        
        // empresa
        
        $('#AddEmpre').click(function(){
            $('#permisoFuncionamiento').hide('slow');
            $('#AddpermisoFuncionamientoEmpresa').show('slow');
        });
        
        $('#CloseAddPermisoEmpre').click(function(){
            $('#AddpermisoFuncionamientoEmpresa').hide('slow');
            $('#permisoFuncionamiento').show('slow');
        });
        
        
    // campos password
    $('.see-pass').mousedown(function() {
        $('input#clave').removeAttr("type");
        $('input#clave').prop('type','text');
    })
    $('.see-pass').mouseup(function() {
        $('input#clave').removeAttr("type");
        $('input#clave').prop('type','password');
    })
    
});