import { useContext } from "react"
import { AuthContext } from "../../context/AuthContext"

export const Header = () => {
    const {user} = useContext(AuthContext);
  return (
    <div className="bg-white py-2 px-6 pl-20 w-[100%]">
        <p className="font-semibold text-lg">👋Hello, {user ? user.full_name : "user"}</p>
        <p className="text-sm">You have 3 projects</p>
    </div>
  )
}
