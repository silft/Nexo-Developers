/*
*-----------------------------------------
* Grunded template - master javascript
*-----------------------------------------
* Here will me located all the javascript
* code doed for that template.
*-----------------------------------------
*/
$(document).ready(function(){
			$("#slider-images").cycle({
				fx : 'fade',
				speed : 500,
				pager : '#slider-dots'
			});
		});

function setupLabel() {
        if ($('.label_check input').length) {
            $('.label_check').each(function(){ 
                $(this).removeClass('c_on');
            });
            $('.label_check input:checked').each(function(){ 
                $(this).parent('label').addClass('c_on');
            });                
        };
        if ($('.label_radio input').length) {
            $('.label_radio').each(function(){ 
                $(this).removeClass('r_on');
            });
            $('.label_radio input:checked').each(function(){ 
                $(this).parent('label').addClass('r_on');
            });
        };
    };
    $(document).ready(function(){
        $('body').addClass('has-js');
        $('.label_check, .label_radio').click(function(){
            setupLabel();
        });
        setupLabel(); 
});