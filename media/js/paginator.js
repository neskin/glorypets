// -------------- Paginator ������� --------------
(function($) {
	$.paginatorScroll = function(ops) {
		ops = ops || {};
		var styleClass = ops.styleClass || 'pag';
		var moveClass = ops.moveClass || 'vertical_area';

		$('.'+styleClass).click(function() {
			paginate_to_page($(this));
		});
	};
})(jQuery);


/*/ ------------- Paginator ���� --------------
(function($){

// Creating the sweetPages jQuery plugin:
$.fn.sweetPages = function(opts){
	
	// If no options were passed, create an empty opts object
	if(!opts) opts = {};	
	
	var resultsPerPage = opts.perPage || 3;
	
	// The plugin works best for unordered lists, althugh ols would do just as well:
	var ul = this;
	
	
	
	// ���� repeatPage == 1, �� ������ �������� ����� �������;
	// ������ ������������ <li> ���� � ������ � ������
	if(opts.repeatPage == 1) {
		var liRepeat = ul.find('.swPage li');	// ������� ��� ���������� <li> ����
		
		liRepeat.each(function() {				// ������ �� ��� ��������� � �������� ������� <ul> ���� holder
			ul.append($(this));
		});
		
												// ������� �� ������ <ul> ������ ���� ������� � ���������� ���������� � �.�.
		ul.find('.swControls').remove();
		ul.find('.swSlider').remove();
		ul.find('.zakrut').remove();
	}
	
	
	
	var li = ul.find('li');
	
	li.each(function(){
		// Calculating the height of each li element, and storing it with the data method:
		var el = $(this);
		el.data('height',el.outerHeight(true));
	});
	
	// Calculating the total number of pages:.filter(function() { return $(this).css('display') == 'none';})
	var pagesNumber = Math.ceil(li.length/resultsPerPage);
	
	// If the pages are less than two, do nothing:
	if(pagesNumber<2) return this;

	// Creating the controls div:
	var swControls = $('<div class="swControls">');
	
	for(var i=0;i<pagesNumber;i++)
	{
		// Slice a portion of the lis, and wrap it in a swPage div:
		li.slice(i*resultsPerPage,(i+1)*resultsPerPage).wrapAll('<div class="swPage" />');
		
		// Adding a link to the swControls div:
		swControls.append('<a href="" style="display: block;" class="swShowPage">'+(i+1)+'</a><br />');
	}

	ul.append(swControls);
	
	
	var minHeight = 200;
	//_maxHeight = maxHeight+30;		// ���������� ��� ����������� ������ �������������� ���� �� script.js
	var totalWidth = 0;
	
	var swPage = ul.find('.swPage');

	swPage.each(function(){
		
		// �������� �� ��������� ��������� � �������������: ������������ ������ � ������ �����
		var elem = $(this);
		
		var tmpHeight = 0;
		elem.find('li').each(function() {
			tmpHeight+=$(this).outerHeight(true); 	// outerHeight(true) - ���������� ������ �������� �� ����� padding � margin =)
		});
		
		if(resultsPerPage > 6)
			tmpHeight = tmpHeight/resultsPerPage*2;
		else
			tmpHeight = tmpHeight/resultsPerPage*2;
		
		if(tmpHeight>minHeight)
			minHeight = tmpHeight;

		totalWidth+=elem.outerWidth();

		elem.css('float','left').width(ul.width());
	});
	
	var ulWidthZakryt = ($(document).width()-ul.width())/2;
	
	// ��������� ��� ����� ����� ��������� �������� ��������� ��� � ����
	ul.find('.swControls').before('<div class="zakrut" style="width: '+ulWidthZakryt+'px; height: '+minHeight+'px; left: -'+ulWidthZakryt+'px;"></div>');
	ul.find('.swControls').before('<div class="zakrut" style="width: '+ulWidthZakryt+'px; height: '+minHeight+'px; left: '+ul.width()+'px; background: none;"></div>');
	
	
	// ������ ������� ���������
	swPage.wrapAll('<div class="swSlider" />');
	
	// ������������� ������ ������ � ������ � ����:
	ul.height(minHeight);
	
	var swSlider = ul.find('.swSlider');
	swSlider.append('<div class="clear" />').width(totalWidth);

	
	// ������ ������:
	var hyperLinks = ul.find('a.swShowPage');
	
	hyperLinks.click(function(e){
		
		// If one of the control links is clicked, slide the swSlider div 
		// (which contains all the pages) and mark it as active:

		$(this).addClass('active').siblings().removeClass('active');
		
		swSlider.stop().animate({'margin-left':-(parseInt($(this).text())-1)*ul.width()},'slow');
		e.preventDefault();
		
		// ��� ���� swPage ������ �� ����� �����������, � ������� ������ �������
		ul.find('.swPage').animate({ opacity: 0.15}, 500);
		ul.find('.swPage').eq(parseInt($(this).text())-1).animate({ opacity: 1}, 300);
	});
	
	// ������������� ������ ������ ��������
	hyperLinks.eq(0).addClass('active');
	
	// ��� ���� swPage ������ �� ����� �����������,� ������ swPage �������
	ul.find('.swPage').css('opacity', 0.15);
	ul.find('.swPage').eq(0).css('opacity', 1); 
	
	// ������������� �������������� <div> ����������
	swControls.css({
		'left':'-30px',
		'top':'-4px',
		'position':'absolute',
	});
	
	return this;
	
}})(jQuery);
*/
