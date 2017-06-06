<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 14.03.17
 * Time: 23:51
 */
$title = 'Панель администратора';
include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/header.php' ?>

<div class="ui grid" xmlns="http://www.w3.org/1999/html">
    <div class="three wide column">
        <? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/sideMenu.php'; ?>
    </div>
    <div class="thirteen wide column">
        <div class="ui grid">
            <div class="eight wide column">
                <div class="ui  segments">
                    <div class="ui segment">
                        <h3>Сейчас в системе</h3>
                    </div>
                    <div class="ui segment">
                        <div class="ui grid">
                            <div class="eight wide column">
                                <div class="ui tiny horizontal statistic">
                                    <div class="value">
                                        <i class="file text icon"></i> <? echo $pageCount; ?>
                                    </div>
                                    <div class="label">
                                        <a href="/mtn-admin/pages">
                                            <? if ($pageCount == 1) {
                                                echo 'страница';
                                            } else if ($pageCount > 1 and $pageCount < 5) {
                                                echo 'страницы';
                                            } else {
                                                echo 'страниц';
                                            } ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="eight wide column">
                                <div class="ui tiny horizontal statistic">
                                    <div class="value">
                                        <i class="user icon"></i> <? echo $userCount; ?>
                                    </div>
                                    <div class="label">
                                        <a href="/mtn-admin/users">
                                            <? if ($pageCount == 1) {
                                                echo 'пользователь';
                                            } else if ($pageCount > 1 and $pageCount < 5) {
                                                echo 'пользователя';
                                            } else {
                                                echo 'пользователей';
                                            } ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui segments">
                    <div class="ui segment">
                        <h3>Активность</h3>
                    </div>
                    <div class="ui segment">
                        <h5>Последние изменения страниц</h5>
                        <? if ($latestPages): ?>
                            <div class="ui list">
                                <? foreach ($latestPages as $page): ?>
                                    <div class="item">
                                        <i class="file text icon"></i>
                                        <div class="content">
                                            <a href="<? echo SITE_URL . $page['page_route']; ?>"><? echo $page['page_title']; ?></a>, <? echo $page['page_modify_date']; ?>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        <? else: ?>
                            <p class="ui tiny center aligned header">
                                Нет активности...
                            </p>
                        <? endif; ?>
                        <h5>Последние пользователи</h5>
                        <? if ($latestUsers): ?>
                            <div class="ui list">
                                <? foreach ($latestUsers as $user): ?>
                                    <div class="item">
                                        <i class="user icon"></i>
                                        <div class="content">
                                            <? echo $user['user_name'] . ' ' . $user['user_surname']; ?>
                                            , <? echo $user['user_creation_date']; ?>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        <? else: ?>
                            <p class="ui tiny center aligned header">
                                Нет активности...
                            </p>
                        <? endif; ?>
                    </div>
                </div>
                <div class="ui segments">
                    <div class="ui segment">
                        <h3>Статистика</h3>
                    </div>
                    <div class="ui segment">
                        <div class="ui grid">
                            <div class="nine wide column">

                                <canvas id="statistics" width="400" height="400"></canvas>
                            </div>
                            <div class="seven wide column">
                                <div class="ui pointing secondary tabular menu">
                                    <a class="item active" data-tab="first">За неделю</a>
                                </div>
                                <div class="ui bottom attached tab active" data-tab="first">
                                    <div class="ui one statistics">
                                        <div class="statistic">
                                            <div class="value">
                                                <? echo $weekViewsCount; ?>
                                            </div>
                                            <div class="label">
                                                Просмотров
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui one statistics margin-top">
                                        <div class="statistic">
                                            <div class="value">
                                                <? echo $uniqCount; ?>
                                            </div>
                                            <div class="label">
                                                Уникальный посетителя
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ui secondary segment">
                        <p>Учитываются все обращения к системе</p>
                    </div>
                </div>
            </div>
            <div class="eight wide column">
                <div class="ui segments">
                    <div class="ui segment">
                        <h3>Добавить объявление</h3>
                    </div>
                    <div class="ui segment">
                        <form class="ui reply form" method="post" id="commentForm">
                            <div class="field">
                                <label for="comment_content">Текст комментария</label>
                                <textarea rows="3" name="comment_content" id="comment_content"
                                          style="resize: none;"></textarea>
                            </div>
                            <button class="ui blue labeled submit icon button right aligned" type="submit">
                                <i class="icon edit"></i> Написать
                            </button>
                            <div class="ui bottom error message errors">
                                <div class="ui bulleted list">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <h3 class="ui dividing header">Доска объявлений
                    <div class="ui tiny inline loader right-float"></div>
                </h3>
                <div class="ui comments">
                    <? if ($commentsList): ?>
                        <? foreach ($commentsList as $comment): ?>
                            <div class="comment" data-id="<? echo $comment['com_id']; ?>">
                                <div class="ui mini icon basic button right-float check-btn display none">
                                    <i class="checkmark icon"></i>
                                </div>
                                <div class="content">
                                    <a class="author"><? echo User::getUsernameById($comment['com_user_id']) ?></a>
                                    <div class="metadata">
                                        <span class="date"><? echo $comment['com_date']; ?></span>
                                    </div>
                                    <div class="text" style="margin-right: 60px;">
                                        <? echo $comment['com_content']; ?>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    <? else: ?>
                        <p class="ui tiny center aligned header" id="noComments">
                            Нет активности...
                        </p>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#commentForm').on("submit", function () {
        var comment = $('#comment_content').val();
        $.ajax({
            url: '/mtn-admin/addcomment',
            type: 'post',
            data: {
                comment_content: comment
            },
            success: function (data) {
                if (data == 1) {
                    toastr.success('Комментарий добавлен!');
                    $('#commentForm').form('clear');
                } else if (data == 0) {
                    toastr.error('Комментарий не сохранен!');
                }
            },
            error: function () {
                toastr.error('Запрос не отправлен!');
            }
        });

        return false;
    });

    $('.comment').mouseover(function () {
        $(this).find('.check-btn').show();
    }).mouseout(function () {
        $(this).find('.check-btn').hide();
    });

    $('.check-btn').mouseover(function () {
        $(this).addClass('green').removeClass('basic');
    }).mouseout(function () {
        $(this).removeClass('green').addClass('basic');
    }).click(function () {
        var thisId = $(this).parent().data('id');

        $.ajax({
            url: '/mtn-admin/checkcomment',
            type: 'post',
            data: {
                comment_id: thisId
            },
            success: function (data) {
                if (data == 1) {
                    toastr.success('Комментарий закрыт!');
                    $('.comment[data-id=' + thisId + ']').remove();

                    var lastId = $('.comment:first').data('id');

                    if (!$(".comments").is(".comment")) {
                        $('#noComments').show();
                    }
                } else if (data == 0) {
                    toastr.error('Комментарий не закрыт!');
                }
            },
            error: function () {
                toastr.error('Запрос не отправлен!');
            }
        });
    });

    function resetBtns() {
        $('.comment').mouseover(function () {
            $(this).find('.check-btn').show();
        }).mouseout(function () {
            $(this).find('.check-btn').hide();
        });

        $('.check-btn').mouseover(function () {
            $(this).addClass('green').removeClass('basic');
        }).mouseout(function () {
            $(this).removeClass('green').addClass('basic');
        }).click(function () {
            var thisId = $(this).parent().data('id');

            $.ajax({
                url: '/mtn-admin/checkcomment',
                type: 'post',
                data: {
                    comment_id: thisId
                },
                success: function (data) {
                    if (data == 1) {
                        toastr.success('Комментарий закрыт!');
                        $('.comment[data-id=' + thisId + ']').remove();

                        var lastId = $('.comment:first').data('id');

                        if (!$(".comments").is(".comment")) {
                            $('#noComments').show();
                        }
                    } else if (data == 0) {
                        toastr.error('Комментарий не закрыт!');
                    }
                },
                error: function () {
                    toastr.error('Запрос не отправлен!');
                }
            });
        });
    }

    function getNewComments() {
        var lastId = $('.comment:first').data('id');

        if (lastId == undefined || lastId == '' || lastId == null) {
            lastId = 0;
        }

        $.ajax({
            url: '/mtn-admin/getnewcomments',
            type: 'post',
            data: {
                lastId: lastId
            },
            beforeSend: function () {
                $('.loader').addClass('active');
            },
            success: function (data) {
                $('.loader').removeClass('active');
                if (data) {
                    var JSONdata = jQuery.parseJSON(data);

                    if (JSONdata) {
                        JSONdata.forEach(function (comment) {
                            var commentItem = `
                        <div class="comment" data-id="` + comment.id + `">
                            <div class="ui mini icon basic button right-float check-btn display none">
                                <i class="checkmark icon"></i>
                            </div>
                            <div class="content">
                                <a class="author">` + comment.author + `</a>
                                <div class="metadata">
                                    <span class="date">` + comment.date + `</span>
                                </div>
                                <div class="text" style="margin-right: 60px;">
                                    ` + comment.content + `
                                </div>
                            </div>
                        </div>
                        `;
                            if (lastId == 0) {
                                $('#noComments').before(commentItem);
                            } else {
                                $('.comment:first').before(commentItem);
                            }
                            $('#noComments').hide();
                            resetBtns();
                        });
                    }
                }
            },
            error: function () {
                $('.loader').removeClass('active');
                toastr.error('Неудалось обновить комментарии!');
            }

        });
    }

    $(document).ready(function () {
        setInterval('getNewComments()', 5000);

        jQuery("#commentForm").form({
            on: 'blur',
            fields: {
                comment_content: {
                    identifier: 'comment_content',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'Пожалуйста, введите комментарий'
                        }
                    ]
                }
            }
        });
    });
</script>

<script src="<? echo SERVICE_PATH . '/js/chart/moment.js' ?>"></script>
<script src="<? echo SERVICE_PATH . '/js/chart/Chart.bundle.min.js' ?>"></script>
<script src="<? echo SERVICE_PATH . '/js/chart/Chart.min.js' ?>"></script>

<script>
    function getDate(date) {
        return moment(date, "DD-MM-YYYY").format('L');
    }

    new Chart(document.getElementById("statistics"), {
        type: 'line',
        data: {
            datasets: [{
                label: "Просмотры",
                backgroundColor: 'rgba(33,133,208, 1)',
                borderColor: 'rgba(33,133,208, 1)',
                fill: false,
                data: [
                        <?foreach($viewStatistic as $view):?>{
                        x: getDate('<?echo $view['date'];?>'),
                        y: <?echo $view['count']?>
                    },<?endforeach;?> ]
            }, {
                label: "Уник. посетители",
                backgroundColor: 'rgba(33,186,69, 1)',
                borderColor: 'rgba(33,186,69, 1)',
                fill: false,
                data: [
                        <?foreach($uniqStatictics as $view):?>{
                        x: getDate('<?echo $view['date'];?>'),
                        y: <?echo $view['count']?>
                    },<?endforeach;?> ]
            }]
        },
        options: {
            responsive: true,
            showLines: true,
            scales: {
                xAxes: [{
                    type: "time",
                    display: true,
                    time: {
                        unit: 'day',
                        displayFormats: {
                            day: 'L'
                        }
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Дата'
                    }
                }],
                yAxes: [{
                    display: true
                }]
            },
            legend: {
                display: true,
                labels: {
                    usePointStyle: true
                }
            }
        }
    });
</script>
<? include_once MTN_ROOT . MTN_ADMIN . '/views/layouts/footer.php' ?>
