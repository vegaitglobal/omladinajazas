<style type="text/css">
<?php watu_resp_table_css(800);?>
</style>

<div class="wrap">
	<h2><?php printf(__("Manage %s", 'watu'), ucfirst(WATU_QUIZ_WORD_PLURAL)); ?></h2>
	
		<div class="postbox-container" style="width:65%;margin-right:2%;">
		
		<p><strong><?php _e('Watu for WordPress is a light version of', 'watu')?> <a href="http://calendarscripts.info/watupro" target="_blank">WatuPRO</a>.</strong></p>
		
		<p><?php _e('Go to', 'watu')?> <a href="admin.php?page=watu_options"><?php _e('Watu Settings', 'watu')?></a>
			&nbsp;|&nbsp;
		<a href="admin.php?page=watu_exam&amp;action=new"><?php printf(__("Create New %s", 'watu'), ucfirst(WATU_QUIZ_WORD))?></a>
			&nbsp;|&nbsp;
		<a href="admin.php?page=watu_social_sharing"><?php _e('Social Sharing Options', 'watu');?></a></p>
		
		<p><b><?php printf(__('To publish a %s copy its shortcode and place it in a post or page. Use only one %s shortcode in each post or page.','watu'), WATU_QUIZ_WORD, WATU_QUIZ_WORD)?></b></p>
			
		<table class="widefat watu-table">
			<thead>
			<tr>
				<th scope="col"><div style="text-align: center;"><?php _e('ID', 'watu') ?></div></th>
				<th scope="col"><a href="admin.php?page=watu_exams&dir=<?php echo $odir?>&ob=Q.name"><?php _e('Title', 'watu') ?></a></th>
				<th scope="col"><?php _e('Shortcode', 'watu') ?></th>
				<th scope="col"><a href="admin.php?page=watu_exams&dir=<?php echo $odir?>&ob=question_count"><?php _e('No. Questions', 'watu') ?></a></th>				
				<th scope="col"><?php _e('View Results', 'watu') ?></th>
				<th scope="col" colspan="3"><?php _e('Action', 'watu') ?></th>
			</tr>
			</thead>
		
			<tbody id="the-list">
		<?php
		if(count($exams)):
			foreach($exams as $quiz):
				$class = ('alternate' == @$class) ? '' : 'alternate';
		
				print "<tr id='quiz-{$quiz->ID}' class='$class'>\n";
				?>
				<td scope="row" style="text-align: center;"><?php echo $quiz->ID ?></td>
				<td><?php if(!empty($quiz->post)) echo "<a href='".get_permalink($quiz->post->ID)."' target='_blank'>"; 
				echo stripslashes($quiz->name);
				if(!empty($quiz->post)) echo "</a>";?></td>
        <td><input type="text" size="8" readonly onclick="this.select()" value="[WATU <?php echo $quiz->ID ?>]"></td>
				<td><?php echo $quiz->question_count ?></td>
				<td><a href="admin.php?page=watu_takings&exam_id=<?php echo $quiz->ID?>"><?php printf(__('Taken %d times', 'watu'), $quiz->taken)?></a></td>
				<td><a href='admin.php?page=watu_questions&amp;quiz=<?php echo $quiz->ID?>' class='edit'><?php _e('Manage Questions', 'watu')?></a><br>
				<a href='admin.php?page=watu_grades&amp;quiz_id=<?php echo $quiz->ID?>' class='edit'><?php _e('Manage Grades', 'watu')?></a></td>
				<td><a href='admin.php?page=watu_exam&amp;quiz=<?php echo $quiz->ID?>&amp;action=edit' class='edit'><?php _e('Edit', 'watu'); ?></a></td>
				<td><a href="<?php echo wp_nonce_url('admin.php?page=watu_exams&amp;action=delete&amp;quiz='.$quiz->ID, 'watu_exams');?>" class='delete' onclick="return confirm('<?php echo  addslashes(sprintf(__("You are about to delete this %s? This will delete all the questions and answers within this quiz. Press 'OK' to delete and 'Cancel' to stop.", 'watu'), WATU_QUIZ_WORD))?>');"><?php _e('Delete', 'watu')?></a></td>
				</tr>
		<?php endforeach;
			else:?>
			<tr>
				<td colspan="5"><?php printf(_e('No %s found.', 'watu'), ucfirst(WATU_QUIZ_WORD_PLURAL)) ?></td>
			</tr>
		<?php endif;?>
			</tbody>
		</table>
		
			<p><a href="admin.php?page=watu_exam&amp;action=new"><?php printf(__("Create New %s", 'watu'), ucfirst(WATU_QUIZ_WORD))?></a></p>
			
			<p><?php printf(__('Get free traffic to your %s by submitting them to', 'watu'), WATU_QUIZ_WORD_PLURAL)?> <a href="http://calendarscripts.info/quizzes/" target="_blank"><?php _e('our directory.')?></a></p>
		</div>
		<div id="watu-sidebar">
				<?php include(WATU_PATH."/views/sidebar.php");?>
		</div>
	</div>	

<script type="text/javascript">
<?php watu_resp_table_js();?>
</script>	