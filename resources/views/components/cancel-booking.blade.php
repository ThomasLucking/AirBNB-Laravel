<form id="delete_form" action="{{ route('booking.cancel', $hasActiveBooking) }}" method="POST">
    @csrf
    @method('DELETE')
</form>