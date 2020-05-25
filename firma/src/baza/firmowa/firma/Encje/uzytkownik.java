package baza.firmowa.firma.Encje;

import java.sql.Timestamp;
import java.util.Set;
import javax.persistence.*;

@Entity
@Table (name="uzytkownik")

public class uzytkownik {
	@Id
	@GeneratedValue
	private int id;
	private String login;
	private String haslo;
	private String rola;
	
	
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getLogin() {
		return login;
	}
	public void setLogin(String login) {
		this.login = login;
	}
	public String getHaslo() {
		return haslo;
	}
	public void setHaslo(String haslo) {
		this.haslo = haslo;
	}
	public String getRola() {
		return rola;
	}
	public void setRola(String rola) {
		this.rola = rola;
	}
}




