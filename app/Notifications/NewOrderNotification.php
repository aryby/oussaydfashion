<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewOrderNotification extends Notification
{
    use Queueable;

    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle commande reçue')
            ->greeting('Bonjour Admin,')
            ->line('Une nouvelle commande a été passée.')
            ->line('Numéro de commande : ' . $this->order->number)
            ->line('Nom client : ' . $this->order->first_name . ' ' . $this->order->last_name)
            ->line('Téléphone : ' . $this->order->phone_number)
            ->line('Adresse : ' . $this->order->street)
            ->line('Montant total : ' . $this->order->grand_total . ' ' . $this->order->currency)
            ->action('Voir la commande', url('/admin/orders/' . $this->order->id))
            ->line('Merci de gérer cette commande rapidement.');
    }
}
