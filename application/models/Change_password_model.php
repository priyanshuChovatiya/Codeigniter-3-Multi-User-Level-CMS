<?php
class Change_password_model extends CI_Model
{
    public function is_valid_password($user_id, $current_password, $user_type)
    {
        $this->db->where('user_id', $user_id);

        // Determine the table name based on the user type
        $table_name = ($user_type == 'user') ? 'user' : (($user_type == 'vendor') ? 'vendor' : 'admin');

        // Assuming you have a 'password' column in each respective table
        // $this->db->where('password', password_hash($current_password, PASSWORD_BCRYPT));

        $query = $this->db->get($table_name);

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function change_password($user_id, $new_password, $user_type)
    {
        // Determine the table name based on the user type
        $table_name = ($user_type == 'user') ? 'user' : (($user_type == 'vendor') ? 'vendor' : 'admin');
        $old_password = $this->db->get_where('users', array('id' => $id))->row('password');

        // Hash the new password before updating the database
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Update the password in the appropriate table
        $data = array('password' => $hashed_password);
        $this->db->where('user_id', $user_id);
        $this->db->update($table_name, $data);
    }
}
