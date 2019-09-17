initNotifications = () => {
    switch(window.location.hash) {
        case "#active-only":
                notifyUser("This account cannot be accessed!");
            break;
        case "#unauth-access":
                notifyUser("アカウントにログインしてください！");
            break;
        case "#admin-only":
                notifyUser("You need administrative privileges!");
            break;
        case "#regular-only":
                notifyUser("Limited to regular users only!");
            break;
        case "#guest-only":
                notifyUser("Limited to guest users only!");
            break;
        case "#non-admin-only":
                notifyUser("This feature is for non-admin users only!");
            break;
        case "#created-form":
                notifyUser("予約要求は提出されました！");
            break;
        case "#updated-form":
                notifyUser("予約取引は更新されました！");
            break;
        case "#temp-unhandled":
                notifyUser("Something went wrong.");
        case "#unavailable":
                notifyUser("Temporarily unavailable.")
        default:
            console.log("Space Control - Reservation Manager");
    }
}

notifyUser = (message) => {
    $('#notify-message').text(message);
    $('#notify-toast').toast('show');
}
