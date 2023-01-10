using System;
using System.Net;
using System.Windows.Forms;
using System.Collections.Specialized;

namespace LoginApp
{
    public partial class LoginForm : Form
    {
        public LoginForm()
        {
            InitializeComponent();
        }

        private void loginButton_Click(object sender, EventArgs e)
        {
            // Create a new WebClient
            using (WebClient client = new WebClient())
            {
                // Set the values for the request data
                string username = usernameTextBox.Text;
                string password = passwordTextBox.Text;
                // Create a new NameValueCollection to store the data
                var data = new NameValueCollection
                {
                    { "username", username },
                    { "password", password }
                };
                // Send the request data to the website
                byte[] response = client.UploadValues("http://localhost/web-app/auth/api/api-login.php", "POST", data);
                string responseString = System.Text.Encoding.Default.GetString(response);
                if (responseString == "success")
                {
                    // Login successful
                    MainForm mainForm = new MainForm();
                    mainForm.Show();
                    this.Hide();
                }
                else
                {
                    // Login unsuccessful
                    MessageBox.Show("Invalid username or password");
                }
            }
        }
    }

    public partial class MainForm : Form
    {
        public MainForm()
        {
            InitializeComponent();
        }
    }
}
