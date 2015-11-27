var stripe = require('stripe')('sk_your_api_key');

stripe.charges.list(
  { limit: 100 },
  function(err, charges) {
    for (i = 0; i < charges.data.length; i++){
      console.log(charges.data[i].id);
    }
    if (charges.has_more) {
      paginateCharges(charges["data"][charges["data"].length - 1].id);
    }
  }
)

function paginateCharges(starting_after) {
  stripe.charges.list(
    { limit: 100, starting_after: starting_after },
    function(err, charges) {
      for (i = 0; i < charges.data.length; i++){
        console.log(charges.data[i].id);
      }
      if (charges.has_more) {
        paginateCharges(charges["data"][charges["data"].length - 1].id);
      }
    }
  )
}