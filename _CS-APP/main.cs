using System;
using System.Windows.Forms;

namespace LoginApp
{
    public partial class MainForm : Form
    {
        private string _username;

        public MainForm()
        {
            InitializeComponent();
        }

        public MainForm(string username) : this()
        {
            _username = username;
            welcomeLabel.Text = $"Welcome, {_username}!";
        }

        private void logoutButton_Click(object sender, EventArgs e)
        {
            // Clear the user's username and redirect to the login form
            _username = "";
            var loginForm = new LoginForm();
            loginForm.Show();
            this.Hide();
        }
    }
}
