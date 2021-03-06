<body id="main">
    <div class="col-sm-9 col-md-10 main">
        <h2 class="page-header">管理首页 >> 管理员管理 >> <strong><?php echo $this->vars['title'];?></strong></h2>

        <div class="table-responsive">
            <?php if (isset($this->vars['show'])) :?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>用户名</th>
                        <th>等级</th>
                        <th>邮箱</th>
                        <th>创建时间</th>
                        <th>修改时间</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->vars['allManages'] as $key => $value) :?>
                    <tr>
                        <td><?=$value['user_id']?></td>
                        <td><?=$value['user_name']?></td>
                        <td><?=$value['role_name']?></td>
                        <td><?=$value['user_email']?></td>
                        <td><?=$value['created_at']?></td>
                        <td><?=$value['updated_at']?></td>
                        <td><a class="btn btn-success btn-sm" href="manage.php?action=update&id=<?=$value['user_id']?>">修改</a> |
                            <a class="btn btn-danger btn-sm" href="manage.php?action=delete&id=<?=$value['user_id']?>"
                               onclick="return confirm('你真的要删除管理员吗？') ? true :false">删除</a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div id="page"><?php echo $this->vars['page'];?></div>
                <a class="col-md-1 btn btn-success" href="manage.php?action=add">新增</a>
            <?php endif; ?>

            <?php if (isset($this->vars['add'])) :?>
                <form method="post" class="col-md-6">
                    <div class="form-group">
                        <label>Username(不得小于2位，大于20位)</label>
                        <input type="text" class="form-control" name="username" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label>Password(不得小于6位)</label>
                        <input type="password" class="form-control" name="userPass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label>Check Password(必须与密码一致)</label>
                        <input type="password" class="form-control" name="checkPass" placeholder="Check Password" />
                    </div>
                    <div class="form-group">
                        <label>Email address(填写正确的邮箱地址)</label>
                        <input type="email" class="form-control" name="userEmail" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label>等级</label>
                        <select name="roleId" class="form-control">
                            <?php foreach ($this->vars['allLevel'] as $key => $value) : ?>
                                <option value="<?=$value['role_id']?>"><?=$value['role_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="submit" name="send" value="新增管理员" onclick="return checkAddForm();"
                           class="submit btn btn-success" />
                    <a class="btn btn-default" href="manage.php?action=show">返回列表</a>
                </form>
            <?php endif; ?>

            <?php if (isset($this->vars['update'])) :?>
                <form method="post" class="col-md-6">
                    <input type="hidden" value="<?=$this->vars['userId']?>" name="userId"/>
                    <input type="hidden" value="<?=$this->vars['roleId']?>" id="roleId"/>
                    <div class="form-group">
                        <label>Username(不得小于2位，大于20位)</label>
                        <input type="text" class="form-control" value="<?=$this->vars['username']?>"
                               name="username" readonly="readonly" placeholder="Username" />
                    </div>
                    <div class="form-group">
                        <label>Password(不得小于6位)</label>
                        <input type="password" class="form-control" name="userPass" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <label>Email address(填写正确的邮箱地址)</label>
                        <input type="email" class="form-control" name="userEmail" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label>等级</label>
                        <select name="roleId" class="form-control">
                            <?php foreach ($this->vars['allRole'] as $key => $value) : ?>
                                <option value="<?=$value['role_id']?>"><?=$value['role_name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="submit" name="send" value="修改管理员" class="submit btn btn-success" />
                    <a class="btn btn-default" href="manage.php?action=show">返回列表</a>
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>