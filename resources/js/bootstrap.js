

import axios from 'axios';
window.axios = axios;
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Pusher = Pusher;


console.log(layout);
console.log(adminId);


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '52e3603b0b42f5032435',
    cluster: 'mt1',


});


window.Echo.private(`admin.${adminId}`)
    .listen('.App\\Events\\CreateOrderEvent', (e) => {
        console.log(e);

        $('.scrollable-container').prepend(
            `
            <a href="${showOrderRoute.replace(":id",e.order_id)}?notify-order=${e.latestNotificationId}">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">${e.message}</h6>
                                                <p class="notification-text font-small-3 text-muted">Order From ${e.user_name}  ${e.total_price} EGP</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00"> ${e.created} </time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
            `
        )
       let count= Number($('#notifications_count').text())
       let count_inside=Number($('#notifications_count_inside').text())
       console.log(count);


       $('#notifications_count').html(count+1)
       $('#notifications_count_inside').html(count_inside+1)

    });


window.Echo.private(`contact.${adminId}`)
    .listen('.App\\Events\\CreateContactEvent', (e) => {
        console.log('وصل الحدث:', e);
          $('.scrollable-container').prepend(
            `
            <a href="${showContactRoute}?notify-contact=${e.latestNotificationId}">
                                        <div class="media">
                                            <div class="media-left align-self-center"><i
                                                    class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i></div>
                                            <div class="media-body">
                                                <h6 class="media-heading">${e.custom_message}</h6>
                                                <p class="notification-text font-small-3 text-muted">Contact From ${e.name}</p>
                                                <small>
                                                    <time class="media-meta text-muted"
                                                        datetime="2015-06-11T18:29:20+08:00"> ${e.created} </time>
                                                </small>
                                            </div>
                                        </div>
                                    </a>
            `
        )
        let count= Number($('#notifications_count').text())
       let count_inside=Number($('#notifications_count_inside').text())
       console.log(count);


       $('#notifications_count').html(count+1)
       $('#notifications_count_inside').html(count_inside+1)
    });
