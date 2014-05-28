<?php $this->widget('bootstrap.widgets.TbTabs', array(
        'id' => 'mytabs',
        'type' => 'tabs',
        'tabs' => array(
                array('id' => 'tab1', 'label' => 'Usuario', 'content' => $this->renderPartial('application.views.usuarios._list', null, true), 'active' => true,),
                array('id' => 'tab2', 'label' => 'Universidades', 'content' => 'loading ....',),
//                array('id' => 'tab3', 'label' => 'Tab 3', 'content' => 'loading ....',),
        ),
        'events'=>array('shown'=>'js:loadContent')
    )    
);

?>

<script type="text/javascript">

function loadContent(e){

    var tabId = e.target.getAttribute("href");

    var ctUrl = ''; 

    if(tabId == '#tab1') {
        ctUrl = '<?php echo $this->createUrl('programa/ProgramasPublicados');?>';
    } else if(tabId == '#tab2') {
        ctUrl = '<?php echo $this->createUrl('universidad/cargar');?>';
    } else if(tabId == '#tab3') {
        ctUrl = '<?php echo $this->createUrl('programa/ProgramasPublicados');?>';
    }

    if(ctUrl != '') {
        $.ajax({
            url      : ctUrl,
            type     : 'POST',
            dataType : 'html',
            cache    : false,
            success  : function(html)
            {
                jQuery(tabId).html(html);
            },
            error:function(){
                    alert('Request failed');
            }
        });
    }
    e.preventDefault();
}


</script>
    