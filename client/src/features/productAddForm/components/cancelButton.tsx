import { XCircleFill } from 'react-bootstrap-icons';

/**
 * Cancel button component.
 *
 * @returns {JSX.Element} The cancel button component.
 */
const CancelButton = (): JSX.Element => {
  const handleCancel = (): void => {
    window.location.href = '/';
  };

  return (
    <button
      onClick={handleCancel}
      type="button"
      className="btn btn-secondary product-form-button btn-icon"
    >
      <div className="icon">
        {' '}
        <XCircleFill />
      </div>
      <p style={{ marginBottom: 0 }}>CANCEL</p>
    </button>
  );
};

export default CancelButton;
