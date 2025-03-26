<div class="addtips"></div><!-- 操作提示 -->

<div class="mb-5">

        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-2 g-4">

            <div class="col">

				<form action="" method="post" class="user_account_form">

					<div class="user_account_lab">
						<label for="nickname">用户昵称</label>
						<input type="text" class="form-control" id="nickname" name="nickname" required="" placeholder="请输入用户昵称" value="<?php echo $current_user->nickname;?>" >
					</div>

					<div class="user_account_lab">
						<label for="email">注册邮箱</label>
						<input type="email" class="form-control" id="email" name="email" required="" placeholder="请输入email" value="<?php echo $current_user->user_email;?>" >
					</div>

					<div class="user_account_lab">
						<label class="">自我介绍</label>
						<textarea class="form-control" id="description" name="description" placeholder="" ><?php echo $current_user->description;?></textarea>
					</div>

					<input type="submit" class="user_account_form_submit user-sub"  value="修改资料">

				</form>

            </div>

            <div class="col">

				<form action="" method="post" class="user_account_form">

					<div class="user_account_lab">
				    	<label class="">输入新密码</label>
				    	<input type="password" class="form-control" id="password" name="password" placeholder="请输入6位以上新密码" required="" >
				    </div>

				    <div class="user_account_lab">
				    	<label class="">重复新密码</label>
				    	<input type="password" class="form-control" id="password2" name="password2" placeholder="请再次输入新密码" required="" >
					</div>

					<input type="submit" class="user_account_form_submit user-password"  value="修改密码">

				</form>

            </div>

        </div>

</div>



<script>
jQuery(document).on("click", ".user-sub",
	function() {
		var email = $('#email').val();
		var nickname = $('#nickname').val();
		var description = $('#description').val();
		jQuery(this).val("提交中…");
		jQuery.ajax({
			url: '/wp-admin/admin-ajax.php',
			type: "POST",
			dataType: 'json',
			data: {
				action:"edit_user_ww",
				email:email,
				nickname:nickname,
				description:description,
				},
			success: function(data) {
				if(data.error=="1"){
					addtips(data.msg);
					jQuery(".user-sub").val("修改资料");
				}
				else{
					addtips(data.msg);
					jQuery(".user-sub").val("修改资料");
					setTimeout(function () { location.reload(); }, 2000);   //2秒后刷新页面
				}
			}
		});
		return false;
	});

jQuery(document).on("click", ".user-password",
	function() {
		var pwd1=$('#password').val();
		var pwd2=$('#password2').val();
		if(pwd1 == pwd2){
			jQuery(this).val("提交中…");
			jQuery.ajax({
				url: '/wp-admin/admin-ajax.php',
				type: "POST",
				dataType: 'json',
				data: {
					action:"edit_user_pw",
					pwd1:pwd1,
					pwd2:pwd2,
					},
				success: function(data) {
					if(data.error=="0"){
						addtips(data.msg);
						jQuery(".user-password").val("重新修改密码");
					}
					else{
						addtips(data.msg);
						jQuery(".user-password").val("修改密码");
						setTimeout(function () { location.reload(); }, 2000);   //2秒后刷新页面
					}
				}
			});
		}
		else{
			addtips("请输入相同的密码");
		}
		return false;
	});

</script>
