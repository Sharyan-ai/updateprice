<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
</head>
<body>
  <h1>WHMCS Product Price Update Module</h1>
  <p>
    This WHMCS module automatically updates the prices of selected products every 12 hours based on the USD rate 
    fetched from the <strong>Nobitex</strong> cryptocurrency exchange (using Tether/USDT as the reference). 
    The module ensures that product prices remain up-to-date in the local currency.
  </p>

  <h2>Features</h2>
  <ul>
    <li>Fetches Tether/USDT price from Nobitex API.</li>
    <li>Updates the prices of specific WHMCS products based on the USD/Tether price.</li>
    <li>Adds a configurable profit margin (%) to the fetched USD price.</li>
    <li>Automatically runs every 12 hours using Cron jobs.</li>
    <li>Logs all actions in WHMCS activity logs for easy monitoring.</li>
  </ul>

  <h2>Installation Guide</h2>

  <h3>Prerequisites</h3>
  <ul>
    <li>A working WHMCS installation.</li>
    <li>PHP version compatible with WHMCS (minimum 7.4 recommended).</li>
    <li>Basic knowledge of WHMCS modules and Cron jobs.</li>
  </ul>

  <h3>Step 1: Download or Clone the Repository</h3>
  <p>Download the module files or clone the repository into your WHMCS installation:</p>
  <pre><code>cd /path/to/whmcs/modules/addons/
git clone https://github.com/yourusername/updateprice.git
  </code></pre>

  <h3>Step 2: File Structure</h3>
  <p>Ensure the following file structure is in place:</p>
  <pre><code>modules/
  addons/
    updateprice/
      hooks.php
      updateprice.php
  </code></pre>

  <h3>Step 3: Activate the Module</h3>
  <ol>
    <li>Log in to the WHMCS Admin area.</li>
    <li>Navigate to <strong>System Settings</strong> → <strong>Addons Modules</strong>.</li>
    <li>Find the module named <strong>"ماژول بروزرسانی قیمت محصولات" (Product Price Update Module)</strong> and click <strong>Activate</strong>.</li>
    <li>Configure the module settings:
      <ul>
        <li><strong>Products for Update:</strong> Enter the product IDs you want to update (comma-separated).</li>
        <li><strong>Profit Margin (%):</strong> Specify a percentage to add to the USD price (e.g., enter <code>5</code> to add a 5% profit margin).</li>
      </ul>
    </li>
  </ol>

  <h3>Step 4: Set Up Cron Job</h3>
  <p>To automate the price updates every 12 hours, add the following Cron job to your server:</p>
  <pre><code>0 */12 * * * php -q /path/to/whmcs/modules/addons/updateprice/hooks.php
  </code></pre>
  <p>Replace <code>/path/to/whmcs</code> with the actual path to your WHMCS installation.</p>

  <h2>How It Works</h2>
  <ol>
    <li>The module uses the Nobitex API to fetch the latest Tether (USDT) to IRR (Iranian Rial) price.</li>
    <li>It calculates the updated price for the selected products using this formula:
      <pre><code>Final Price = (USDT Price from Nobitex) * (1 + Profit Margin/100)
      </code></pre>
    </li>
    <li>It updates the WHMCS product prices (monthly, quarterly, semi-annually, annually) in the database.</li>
    <li>The process is automated via Cron jobs and logged in the WHMCS Activity Logs.</li>
  </ol>

  <h2>Configuration Options</h2>
  <table>
    <thead>
      <tr>
        <th>Setting</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><strong>Products for Update</strong></td>
        <td>Comma-separated list of product IDs whose prices need to be updated.</td>
      </tr>
      <tr>
        <td><strong>Profit Margin (%)</strong></td>
        <td>Additional profit percentage added to the USD price. Default is <code>0%</code>.</td>
      </tr>
    </tbody>
  </table>

  <h2>API Integration</h2>
  <p>
    This module integrates with the Nobitex API to fetch the latest Tether (USDT) price. Here's the API endpoint used:
  </p>
  <ul>
    <li><strong>Endpoint:</strong> <code>https://api.nobitex.ir/market/stats</code></li>
    <li><strong>Response Example:</strong></li>
  </ul>
  <pre><code>{
  "stats": {
    "USDTIRT": {
      "latest": 523000
    }
  }
}
  </code></pre>

  <h2>Logging</h2>
  <p>
    The module logs its operations in the WHMCS Activity Logs. Check these logs for details about:
  </p>
  <ul>
    <li>Successful price updates.</li>
    <li>Errors in fetching the Tether price.</li>
    <li>Any skipped products due to misconfiguration.</li>
  </ul>

  <h2>Troubleshooting</h2>
  <h3>Common Issues</h3>
  <ul>
    <li><strong>No Price Updates:</strong>
      <ul>
        <li>Ensure the product IDs in the module settings are correct.</li>
        <li>Check the Cron job logs to ensure the module runs successfully.</li>
      </ul>
    </li>
    <li><strong>API Errors:</strong>
      <ul>
        <li>Verify that Nobitex API is accessible from your server.</li>
        <li>Check for any connectivity issues or IP blocks.</li>
      </ul>
    </li>
    <li><strong>Incorrect Prices:</strong>
      <ul>
        <li>Double-check the profit margin percentage in the module configuration.</li>
        <li>Ensure the exchange rate from Nobitex is correct.</li>
      </ul>
    </li>
  </ul>

  <h2>Contribution</h2>
  <p>
    Feel free to contribute to this module by submitting pull requests or reporting issues in the repository. 
    We welcome your feedback and improvements!
  </p>

  <h2>License</h2>
  <p>This project is licensed under the <a href="LICENSE">MIT License</a>.</p>
</body>
</html>
