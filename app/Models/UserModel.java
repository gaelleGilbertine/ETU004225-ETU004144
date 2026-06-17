public class UserModel {
    private int id;
    private String username;
    private String mdp;

    public UserModel() {}

    public UserModel(int id, String username, String mdp) {
        this.id = id;
        this.username = username;
        this.mdp = mdp;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public String getUsername() { return username; }
    public void setUsername(String username) { this.username = username; }

    public String getMdp() { return mdp; }
    public void setMdp(String mdp) { this.mdp = mdp; }
}