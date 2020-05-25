package baza.firmowa.firma.Encje;
import java.sql.Timestamp;
import java.util.Set;
import javax.persistence.*;

@Entity
@Table (name="zlecenie")

public class zlecenie {
	@Id
	@GeneratedValue
	private int id;
	private String adres;
	private String typ_prac;
	private int metraz;
	private int ustalona_cena;
	private int przewidywany_zysk;
	
	public int getId() {
		return id;
	}
	
	public void setId(int id) {
		this.id = id;
	}

	public String getAdres() {
		return adres;
	}

	public void setAdres(String adres) {
		this.adres = adres;
	}

	public String getTyp_prac() {
		return typ_prac;
	}

	public void setTyp_prac(String typ_prac) {
		this.typ_prac = typ_prac;
	}

	public int getMetraz() {
		return metraz;
	}

	public void setMetraz(int metraz) {
		this.metraz = metraz;
	}

	public int getUstalona_cena() {
		return ustalona_cena;
	}

	public void setUstalona_cena(int ustalona_cena) {
		this.ustalona_cena = ustalona_cena;
	}

	public int getPrzewidywany_zysk() {
		return przewidywany_zysk;
	}

	public void setPrzewidywany_zysk(int przewidywany_zysk) {
		this.przewidywany_zysk = przewidywany_zysk;
	}


	
	
	
	

}
