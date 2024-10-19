# composer install
# sign up stripe account to get stripe key, stripe secret key
# integrate stripe to .env file by the following
   Ex: - STRIPE_KEY='pk_test_51Q9jnERtBaBYmmR4pduJsbJdpjG9T6b4DPVvtWJszbryJJYSwR2hqg5UjaihkPSan8nPFbrr4IdE5ZuOo45dTnVL00ZiM6U7jN'
       - STRIPE_SECRET='sk_test_51Q9jnERtBaBYmmR485uwwCMVr8SuMoWrBgJ1KHYgnicTQaDurz6v3CBJLIOWtwefHbZ8E1UiXPwBtbZ4XKWmWhE800GNx4LN8c'
       - STRIPE_WEBHOOK_SECRET="whsec_c9de8d2cd788fb53cc6b79428faba4cbc7f1b89fd6961c92fcf5d836a4f58d3f" 
       - CASHIER_CURRENCY=usd
# Note: for STRIPE_WEBHOOK_SECRET , we need to do by the following:
      - run php artisan stripe:webhook (this command run successfully even url is like eg: http://laravel-cashier.test not http://localhost or http://127.0.0.1:8000)
      - when you run successfully, it will generate the WEBHOOK_SECRECT to us and it will show our endpoint url in stripe dashboard https://dashboard.stripe.com/test/workbench/webhooks
