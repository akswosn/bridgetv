
@if(!empty($pageNavigator))
<nav class="page-wrap">
	<ul class="pagination">
		@if($pageNavigator['page'] > 10)
			<li class="page-item"><a class="page-link" aria-label="Previous" href="{{$pageNavigator['url']}}/{{$pageNavigator['first']-10}}">
				<i class="fa fa-angle-left"></i>
			</a></li>
		@endif
		
		@for ($i = $pageNavigator['first']; $i <= $pageNavigator['last']; $i++)
			@if($i == $pageNavigator['page'])
				<li class="page-item"><a class="page-link" href="{{$pageNavigator['url']}}/{{$i}}"  class="active" style="font-weight:bold;color:blue">{{$i}}</a></li>
			@else
				<li class="page-item"><a class="page-link" href="{{$pageNavigator['url']}}/{{$i}}" >{{$i}}</a></li>
			@endif
		@endfor
		
		@if($pageNavigator['totalList'] - $pageNavigator['page'] > 10)
			<li class="page-item" ><a class="page-link" aria-label="Next" href="{{$pageNavigator['url']}}/{{$pageNavigator['first']+10}}">
				<i class="fa fa-angle-right"></i>
			</a></li>			 
		@endif
	</ul>
</nav>
@endif