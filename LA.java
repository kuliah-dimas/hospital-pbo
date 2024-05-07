
public class LA {
    public static void main(String[] args) {
        Bentuk bentuk1 = new PersegiPanjang(5, 10);
        Bentuk bentuk2 = new Lingkaran(7);
        System.out.println("Luas bentuk 1: " + bentuk1.hitungLuas());
        System.out.println("Luas bentuk 2: " + bentuk2.hitungLuas());
    }
}

class Bentuk {
    double hitungLuas() {
        System.out.println("Menghitung luas bentuk apa pun...");
        return 0;
    }
}

class PersegiPanjang extends Bentuk {
    double panjang;
    double lebar;

    PersegiPanjang(double panjang, double Lebar) {
        this.panjang = panjang;
        this.lebar = Lebar;
    }

    double hitungLuas() {
        System.out.println("Menghitung luas persegi panjang...");
        return panjang * lebar;
    }
}

class Lingkaran extends Bentuk {
    double jariJari;

    Lingkaran(double jariJari) {
        this.jariJari = jariJari;
    }

    double hitungLuas() {
        System.out.println("Menghitung luas lingkaran...");
        return Math.PI * jariJari * jariJari;
    }
}