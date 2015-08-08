jQuery(document).ready(function() {
    var collectionHolder = $( "*" ).find('[data-prototype]');
    
    for (var i = 0; i < collectionHolder.length; i++) {
        DynamicForm(collectionHolder[i]);
    }
});

function DynamicForm(collectionH){
    var $collectionHolder = $(collectionH);
    var $add = $('<a href="#" class="add_link"> Ajouter</a>');
    var $count = $collectionHolder.children().length;
    $collectionHolder.append($add);

    var collectionChild = $collectionHolder.children("div");
    
    for (var i = 0; i < collectionChild.length; i++) {
        addDeleteForm($(collectionChild[i]));     
    }

    if($collectionHolder.attr('data-prototype').localeCompare("self-referencing")==0)
    {
        var parentPrototype = $collectionHolder.parent().parent().parent().parent().attr('data-prototype');
        console.log(parentPrototype);

        var parentIdentifier = $collectionHolder.parent().parent().parent().parent().attr('id');
        console.log(parentIdentifier);
        var childIdentifier = $collectionHolder.attr('id');

        var childPrototype = parentPrototype;

        $regExp = new RegExp (parentIdentifier, "g");
        childPrototype = childPrototype.replace($regExp, childIdentifier);

        str = parentIdentifier.split('_');
        str[1] = str[0]+"\\["+str[1];
        str.splice(0,1);
        str = str.join("\\]\\[");
        $regExp = new RegExp (str+"\\]", "g");

        str = childIdentifier.split('_');
        str[1] = str[0]+"["+str[1];
        str.splice(0,1);
        str = str.join("][");
        childPrototype = childPrototype.replace($regExp, str+"]");

        $collectionHolder.attr('data-prototype',childPrototype);
    }

    $add.on('click', function(e) {
        e.preventDefault();
        var prototype = $collectionHolder.attr('data-prototype');
        
        var $identifier = $collectionHolder.attr('id');
        
        var $form = prototype;
        
        $regExp = new RegExp ($identifier+"___name__", "g");
        $form = $form.replace($regExp, $identifier+"_"+$count);
        $form = $form.replace("__name__label__", $count);

        str = $identifier.split('_');
        str[1] = str[0]+"\\["+str[1];
        str.splice(0,1);
        str = str.join("\\]\\[");
        $regExp = new RegExp (str+"\\]\\[__name__\\]", "g");

        str = str.replace(/\\/g,'');
        $form = $form.replace($regExp, str+"]["+$count+"]");

        $add.before($form);

        $form = $collectionHolder.find('#'+$identifier+'_'+$count).parent();

        addDeleteForm($form);      
                      
        var collectionH = $form.find('[data-prototype]');
    
        for (var i = 0; i < collectionH.length; i++) {
            if($(collectionH[i]).attr('data-prototype').localeCompare("self-referencing")==0)
                {
                    var parentPrototype = $collectionHolder.attr('data-prototype');

                    var parentIdentifier = $collectionHolder.attr('id');

                    var childIdentifier = $(collectionH[i]).attr('id');

                    var childPrototype = parentPrototype;

                    $regExp = new RegExp (parentIdentifier, "g");
                    childPrototype = childPrototype.replace($regExp, childIdentifier);

                    str = parentIdentifier.split('_');
                    str[1] = str[0]+"\\["+str[1];
                    str.splice(0,1);
                    str = str.join("\\]\\[");
                    $regExp = new RegExp (str+"\\]", "g");

                    str = childIdentifier.split('_');
                    str[1] = str[0]+"["+str[1];
                    str.splice(0,1);
                    str = str.join("][");
                    childPrototype = childPrototype.replace($regExp, str+"]");

                    $(collectionH[i]).attr('data-prototype',childPrototype);
                }
            DynamicForm(collectionH[i]);
        };

        $count++;
    });
}

function addDeleteForm (form){
    var $deleteForm = $('<a href="#">Supprimer</a>');
    form.append($deleteForm);

    $deleteForm.on('click', function(e) {
        e.preventDefault();
        form.remove();
    });
}
