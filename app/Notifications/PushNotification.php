<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Notifications\FirebaseChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
class PushNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $title = '';
    public $body = '';
    public $action = '';
    public $image = '';
    public $icon = '';
    public function __construct($title, $body, $action, $image, $logo)
    {
        $this->title = $title;
        $this->body = $body;
        $this->action = $action;
        $this->image = $image;
        $this->icon = $logo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FirebaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toFirebase($notifiable)
    {
       $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "registration_ids":["'.$notifiable.'"],
            "data":{
                "title":"'.$this->title.'",
                "body":"'.$this->body.'",
                "action": "'.$this->action.'",
                "icon": "'.$this->icon.'",
                "image": "'.$this->image.'",
            }
        }',
        
          CURLOPT_HTTPHEADER => array(
            'Authorization: key=AAAAVMgullw:APA91bEHox_63kLeTD6VcEx5RT8slAye1jM5Dbmpft7SfjC4IioSORZstF3SaHUnAOZv3LgklfaJin7NGyBd2mrYGSZyfyqEd2dZmVaRw3tIcNCuN0_1VrroPTQ02bILXqrM8MApAzao',
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
