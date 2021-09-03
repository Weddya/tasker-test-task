<div class="container-fluid">
    <div class="row">
        <main role="main" class="col-md-9 col-lg-10 mx-auto">
            <a href="/add" class="btn btn-primary float-right">Добавить</a>
            <h2>Список задач</h2>
            <div id="ajax-message"></div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>
                            <?php if ($sort == 'sortUsernameAsc'): ?>
                                <a href="sortUsernameDesc" class="sort-link">
                                    Имя пользователя
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <a href="sortUsernameAsc" class="sort-link">
                                    Имя пользователя
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </th>
                        <th>
                            <?php if ($sort == 'sortEmailAsc'): ?>
                                <a href="sortEmailDesc" class="sort-link">
                                    Email
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <a href="sortEmailAsc">
                                    Email
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </th>
                        <th>Текст задачи</th>
                        <th>
                            <?php if ($sort == 'sortStatusAsc'): ?>
                                <a href="sortStatusDesc" class="sort-link">
                                    Статус
                                    <i class="fa fa-angle-up" aria-hidden="true"></i>
                                </a>
                            <?php else: ?>
                                <a href="sortStatusAsc">
                                    Статус
                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                </a>
                            <?php endif; ?>
                        </th>
                        <?php if ($adminAccess): ?>
                            <th></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr class="<?php echo $task['status'] ? 'table-success' : '';?>">
                            <td><?php echo $task['username']; ?></td>
                            <td><?php echo $task['email']; ?></td>
                            <td><?php if ($task['edited_by_admin']): ?>
                                <p><small>(отредактировано администратором)</small></p>
                                <?php endif; ?>
                                <?php echo $task['text']; ?>
                            </td>
                            <td>
                                <button
                                    class="change-status btn btn-outline-primary"
                                    data-status="<?php echo $task['status']; ?>"
                                    data-id="<?php echo $task['id']; ?>">
                                        <?php echo $task['status'] ? 'Выполнено' : 'Не выполнено'; ?>
                                </button>
                            </td>
                            <?php if ($adminAccess): ?>
                                <td>
                                    <a href="/edit/<?php echo $task['id']; ?>" class="btn btn-outline-primary">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php echo $pagination; ?>
        </main>
    </div>
</div>