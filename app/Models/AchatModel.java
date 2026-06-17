public class AchatModel {
    private int id;
    private int idUser;
    private int idCaisse;
    private String nomClient;
    private String date;

    public AchatModel() {}

    public AchatModel(int id, int idUser, int idCaisse, String nomClient, String date) {
        this.id = id;
        this.idUser = idUser;
        this.idCaisse = idCaisse;
        this.nomClient = nomClient;
        this.date = date;
    }

    public int getId() { return id; }
    public void setId(int id) { this.id = id; }

    public int getIdUser() { return idUser; }
    public void setIdUser(int idUser) { this.idUser = idUser; }

    public int getIdCaisse() { return idCaisse; }
    public void setIdCaisse(int idCaisse) { this.idCaisse = idCaisse; }

    public String getNomClient() { return nomClient; }
    public void setNomClient(String nomClient) { this.nomClient = nomClient; }

    public String getDate() { return date; }
    public void setDate(String date) { this.date = date; }
}