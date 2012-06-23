{news}
<div class="box">
			<div class="header"><span>{title}</span></div>
			<div class="pre-content"></div>
			<div class="content">
			{content}
            <div class="divider"></div>
            <div style="float:left; width: 300px;">Posted by <span style="color:#f5b50c;">{author}</span> | {date}</div>
			<div style="float:right;width:300px;text-align:right;padding-right:5px;">(<span style="color:#f5b50c;">{total_comments}</span>) Comments</div>
            <div class="clear"></div>
			</div>
			<div class="bottom"></div>
		</div>
{/news}

<div class="box">
			<div class="header"><span>Comments</span></div>
			<div class="pre-content"></div>
			<div class="content">
            	<div id="comments">
			{comments}
            		<div class="comment">
                    	<div class="left">
                        <img src="/public/avatars/{author}.png" width="80" height="80"  /><br />
                        <a href="#">{author}</a>
                        </div>
                        <div class="right">{content}</div>
                        <div class="clear"></div>
            		</div>
            {/comments}
            	</div>
            </div>
			<div class="bottom"></div>
		</div>