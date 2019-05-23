<?php $__env->startSection('main'); ?>
<!-- 内容 -->
<div class="col-md-10">
	
	<ol class="breadcrumb">
		<li><a href="#"><span class="glyphicon glyphicon-home"></span> 首页</a></li>
		<li><a href="#">评论管理</a></li>
		<li class="active">评论列表</li>

		<button class="btn btn-primary btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span></button>
	</ol>

	<!-- 面版 -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<button class="btn btn-success"> 查看评论</button>
			
			<p class="pull-right tots" >共有 10 条数据</p>
			<form action="" class="form-inline pull-right">
				<div class="form-group">
					<input type="text" name="" class="form-control" placeholder="请输入你要搜索的内容" id="">
				</div>
				
				<input type="submit" value="搜索" class="btn btn-success">
			</form>


		</div>
		<table class="table-bordered table table-hover">
			<th>ID</th>
			<th>UAME</th>
			<th>商品名</th>
			<th>商品图片</th>
			<th>内容</th>
			<th>星级</th>
			<th>时间</th>
			<th>状态</th>

			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<tr>
					<td><?php echo e($value->id); ?></td>
					<td><?php echo e($value->name); ?></td>
					<td><?php echo e($value->title); ?></td>
					<td><img width="200px" src="/Uploads/goods/<?php echo e($value->gimg); ?>" alt=""></td>
					<td><?php echo e($value->text); ?></td>
					<td style="color:red"><?php echo e(str_repeat("★",$value->start)); ?><?php echo e(str_repeat('☆',5-$value->start)); ?></td>
					<td ><?php echo e(date("Y-m-d H:i:s",$value->time)); ?></td>
					<td>

						<select name="" onchange="a(this,<?php echo e($value->id); ?>)" id="">
						<?php if($value->statu==1): ?>
							<option value="0">未审核</option>
							<option selected value="1">正常</option>
							<option value="2">黑名单</option>

						<?php elseif($value->statu==2): ?>
							<option value="0">未审核</option>
							<option value="1">正常</option>
							<option selected value="2">黑名单</option>
							
						<?php else: ?>
							<option selected value="0">未审核</option>
							<option value="1">正常</option>
							<option value="2">黑名单</option>

						<?php endif; ?>

						</select>
					</td>
				
				</tr>


			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

			

			

		</table>
		<!-- 分页效果 -->
		<div class="panel-footer">
			<nav style="text-align:center;">
				<!-- <ul class="pagination">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul> -->
			</nav>

		</div>
	</div>
</div>
<script>
	
	function a(obj,id){
		// 获取自己的值

		val=$(obj).val();

		// 发送ajax请求

		$.post("/admin/comment/ajaxStatu",{"id":id,"statu":val,"_token":'<?php echo e(csrf_token()); ?>'},function(data){

			if (data==1) {
				alert('修改成功');
			}else{
				alert('修改失败');
			}

		})
	}
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.public.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>