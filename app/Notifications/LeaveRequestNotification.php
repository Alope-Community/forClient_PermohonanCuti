<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveRequestNotification extends Notification
{
    use Queueable;

    protected $leaveRequestId;
    protected $alasan;
    protected $totalCuti;
    protected $employeeName;
    protected $role;

    /**
     * Create a new notification instance.
     */
    public function __construct($leaveRequestId, $employeeName, $totalCuti, $alasan, $role)
    {
        $this->leaveRequestId = $leaveRequestId;
        $this->employeeName = $employeeName;
        $this->totalCuti = $totalCuti;
        $this->alasan = $alasan;
        $this->role = $role;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'leave_request_id' => $this->leaveRequestId,
            'employee_name' => $this->employeeName,
            'total_cuti' => $this->totalCuti,
            'alasan' => $this->alasan,
            'role' => $this->role,
        ];
    }
}
