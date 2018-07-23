<body id="main">
    <div class="col-sm-9 col-md-10 main">
        <h2 class="page-header">管理首页 >> 管理员管理 >> <strong><?php echo $this->vars['title'];?></strong></h2>

        <div class="table-responsive">
            <?php if (isset($this->vars['show'])) :?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>等级名称</th>
                        <th>等级描述</th>
                        <th>排序等级</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->vars['allRoles'] as $key => $value) :?>
                    <tr>
                        <td><?=$value['role_id']?></td>
                        <td><?=$value['role_name']?></td>
                        <td><?=$value['role_description']?></td>
                        <td><?=$value['role_sort']?></td>
                        <td><a class="btn btn-success btn-sm" href="role.php?action=update&id=<?=$value['role_id']?>">修改</a> |
                            <a class="btn btn-danger btn-sm" href="role.php?action=delete&id=<?=$value['role_id']?>"
                               onclick="return confirm('你真的要删除等级吗？') ? true :false">删除</a></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <a class="btn btn-success" href="role.php?action=add">新增</a>
            <?php endif; ?>

            <?php if (isset($this->vars['add'])) :?>
                <form method="post" class="col-md-6">
                    <div class="form-group">
                        <label>Role name</label>
                        <input type="text" class="form-control" name="roleName" placeholder="Role name">
                    </div>
                    <div class="form-group">
                        <label>Role sort</label>
                        <input type="text" class="form-control" name="roleSort" placeholder="Role sort">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="roleDescription" placeholder="Description"></textarea>
                    </div>
                    <input type="submit" name="send" value="新增等级" class="submit btn btn-success" />
                    <a class="btn btn-default" href="role.php?action=show">返回列表</a>
                </form>
            <?php endif; ?>

            <?php if (isset($this->vars['update'])) :?>
                <form method="post" class="col-md-6">
                    <input type="hidden" value="<?=$this->vars['roleId']?>" name="roleId"/>
                    <div class="form-group">
                        <label>Role name</label>
                        <input type="text" class="form-control" name="roleName"
                               value="<?=$this->vars['roleName']?>" placeholder="Role name">
                    </div>
                    <div class="form-group">
                        <label>Role sort</label>
                        <input type="text" class="form-control" name="roleSort"
                               value="<?=$this->vars['roleSort']?>" placeholder="Role sort">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="roleDescription"
                                  placeholder="Description"><?=$this->vars['roleDescription']?></textarea>
                    </div>
                    <input type="submit" name="send" value="修改等级" class="submit btn btn-success" />
                    <a class="btn btn-default" href="role.php?action=show">返回列表</a>
                </form>
            <?php endif; ?>
        </div>
    </div>

</body>