var stripe = require('stripe')('sk_your_api_key');

stripe.events.list(
  { limit: 100, type: 'invoice.payment_succeeded' },
  function(err, events) {
    for (i = 0; i < events.data.length; i++){
      console.log(events.data[i].id);
    }
    if (events.has_more) {
      paginateEvents(events["data"][events["data"].length - 1].id);
    }
  }
)

function paginateEvents(starting_after) {
  stripe.events.list(
    { limit: 100, type: 'invoice.payment_succeeded', starting_after: starting_after },
    function(err, events) {
      for (i = 0; i < events.data.length; i++){
        console.log(events.data[i].id);
      }
      if (events.has_more) {
        paginateEvents(events["data"][events["data"].length - 1].id);
      }
    }
  )
}