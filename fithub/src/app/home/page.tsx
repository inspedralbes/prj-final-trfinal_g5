import Link from "next/link";

export default function Home() {
  return (
    <div className="flex flex-col items-center justify-center h-screen bg-orange-500">
      <div className="mb-6">
        <img src="/logo_fithub.png" alt="FitHub Logo" width={300} height={300} />
      </div>
      {/* Header con nombre de usuario y foto de perfil */}
      <header className="bg-orange-500 p-4 text-white">
        <div className="flex items-center">
          <img
            src="/user_profile_placeholder.jpg" // Ruta de la imagen de perfil
            alt="User Profile"
            className="w-8 h-8 rounded-full mr-2"
          />
          <span>Nombre de Usuario</span>
        </div>
      </header>

      {/* Botones de imágenes */}
      <div className="flex justify-around mt-4">
        <div>
          <Link href="/rutina">
            <img
              src="/rutina_imagen.png" // Ruta de la imagen para la rutina
              alt="Rutina"
              className="w-20 h-20 object-cover rounded-lg cursor-pointer"
            />
          </Link>
          <span className="block text-center mt-2">Rutina</span>
        </div>
        <div>
          <Link href="/dieta">
            <img
              src="/dieta_imagen.png" // Ruta de la imagen para la dieta
              alt="Dieta"
              className="w-20 h-20 object-cover rounded-lg cursor-pointer"
            />
          </Link>
          <span className="block text-center mt-2">Dieta</span>
        </div>
        <div>
          <Link href="/asesoramiento">
            <img
              src="/asesoramiento_imagen.png" // Ruta de la imagen para el asesoramiento
              alt="Asesoramiento"
              className="w-20 h-20 object-cover rounded-lg cursor-pointer"
            />
          </Link>
          <span className="block text-center mt-2">Asesoramiento</span>
        </div>
      </div>
    </div>
  );
}
