var stripe = require('stripe')('sk_your_api_key');

stripe.customers.list(
  { limit: 100 },
  function(err, customers) {
    for (i = 0; i < customers.data.length; i++){
      console.log(customers.data[i].id);
    }
    if (customers.has_more) {
      paginateCustomers(customers["data"][customers["data"].length - 1].id);
    }
  }
)

function paginateCustomers(starting_after) {
  stripe.customers.list(
    { limit: 100, starting_after: starting_after },
    function(err, customers) {
      for (i = 0; i < customers.data.length; i++){
        console.log(customers.data[i].id);
      }
      if (customers.has_more) {
        paginateCustomers(customers["data"][customers["data"].length - 1].id);
      }
    }
  )
}