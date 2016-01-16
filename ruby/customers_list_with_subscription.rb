# Lists all active subscriptions and their next payment date. Outputs to CSV. 
require 'stripe'
require 'csv'

Stripe.api_key = "sk_your_api_key"

# get the first 100 customers
customers = Stripe::Customer.all(:limit => 100)

# create a csv called 'stripe_customer_report'
CSV.open("stripe_customer_report.csv", "w") do |csv|
  csv << ["Customer ID", "Subscription ID", "Plan name", "Next payment date"]

  # iterate through customers and subs
  customers.each do |customer|
    if customer.subscriptions
      # list each active subscription
      customer.subscriptions.each do |s|
        csv << [customer.id, s.id, s.plan.name, Time.at(s.current_period_end).strftime("%m-%d-%Y")]
      end

      # returns 10 by default, so find additional subs if they exist
      if customer.subscriptions.has_more
        subscriptions = Stripe::Customer.retrieve(customer.id).subscriptions.all(:limit => 100, :starting_after => customer.subscriptions.data.last.id)

        subscriptions.each do |s|
          csv << [customer.id, s.id, s.plan.name, Time.at(s.current_period_end).strftime("%m-%d-%Y")]
        end
      end
    end
  end

  # iterate through the next hundred customers
  while customers.has_more do
    customers = Stripe::Customer.all(:limit => 100, :starting_after => customers.data.last.id)

    customers.each do |customer|
      if customer.subscriptions
        customer.subscriptions.each do |s|
          csv << [customer.id, s.id, s.plan.name, Time.at(s.current_period_end).strftime("%m-%d-%Y")]
        end

        if customer.subscriptions.has_more
        subscriptions = Stripe::Customer.retrieve(customer.id).subscriptions.all(:limit => 100, :starting_after => customer.subscriptions.data.last.id)
          subscriptions.each do |s|
            csv << [customer.id, s.id, s.plan.name, Time.at(s.current_period_end).strftime("%m-%d-%Y")]
          end
        end
      end
    end
  end
end